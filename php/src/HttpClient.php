<?php

declare(strict_types=1);

namespace EZScale\VirtFusion;

use EZScale\VirtFusion\Exceptions\AuthenticationException;
use EZScale\VirtFusion\Exceptions\AuthorizationException;
use EZScale\VirtFusion\Exceptions\NotFoundException;
use EZScale\VirtFusion\Exceptions\RateLimitException;
use EZScale\VirtFusion\Exceptions\ServerException;
use EZScale\VirtFusion\Exceptions\ValidationException;
use EZScale\VirtFusion\Exceptions\VirtFusionException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class HttpClient
{
    private readonly Client $client;

    public function __construct(
        string $baseUrl,
        string $apiToken,
        ?Client $client = null,
    ) {
        $this->client = $client ?? new Client([
            'base_uri' => rtrim($baseUrl, '/') . '/api/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $apiToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'http_errors' => true,
        ]);
    }

    /**
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    public function request(string $method, string $uri, array $options = []): array
    {
        try {
            $response = $this->client->request($method, $uri, $options);
            $body = (string) $response->getBody();

            if ($body === '') {
                return [];
            }

            return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (RequestException $e) {
            throw $this->mapException($e);
        } catch (ConnectException $e) {
            throw new VirtFusionException(
                'Failed to connect to VirtFusion API: ' . $e->getMessage(),
                0,
                $e,
            );
        } catch (\JsonException $e) {
            throw new VirtFusionException(
                'Failed to decode API response: ' . $e->getMessage(),
                0,
                $e,
            );
        }
    }

    private function mapException(RequestException $e): VirtFusionException
    {
        $response = $e->getResponse();

        if ($response === null) {
            return new VirtFusionException(
                'Request failed: ' . $e->getMessage(),
                0,
                $e,
            );
        }

        $statusCode = $response->getStatusCode();
        $body = json_decode((string) $response->getBody(), true) ?? [];
        $message = $body['message'] ?? $body['error'] ?? $e->getMessage();

        return match (true) {
            $statusCode === 401 => new AuthenticationException($message, $statusCode, $e),
            $statusCode === 403 => new AuthorizationException($message, $statusCode, $e),
            $statusCode === 404 => new NotFoundException($message, $statusCode, $e),
            $statusCode === 422 => new ValidationException(
                $message,
                $body['errors'] ?? [],
                $statusCode,
                $e,
            ),
            $statusCode === 429 => new RateLimitException(
                $message,
                $this->parseRetryAfter($response->getHeaderLine('Retry-After')),
                $statusCode,
                $e,
            ),
            $statusCode >= 500 => new ServerException($message, $statusCode, $e),
            default => new VirtFusionException($message, $statusCode, $e),
        };
    }

    private function parseRetryAfter(string $header): ?int
    {
        if ($header === '') {
            return null;
        }

        return (int) $header;
    }
}
