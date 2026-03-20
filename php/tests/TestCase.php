<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests;

use EZScale\VirtFusion\HttpClient;
use EZScale\VirtFusion\VirtFusion;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /** @var array<int, array<string, mixed>> */
    protected array $history = [];

    protected function mockClient(Response ...$responses): VirtFusion
    {
        $http = $this->mockHttp(...$responses);

        return new VirtFusion('https://cp.test.com', 'test-token', $http);
    }

    protected function mockHttp(Response ...$responses): HttpClient
    {
        $mock = new MockHandler($responses);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($this->history));

        $client = new Client([
            'handler' => $stack,
            'base_uri' => 'https://cp.test.com/api/v1/',
            'headers' => [
                'Authorization' => 'Bearer test-token',
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return new HttpClient('https://cp.test.com', 'test-token', $client);
    }

    protected function jsonResponse(string $fixtureName, int $status = 200): Response
    {
        $path = __DIR__ . '/Fixtures/' . $fixtureName;
        $body = file_get_contents($path);

        return new Response($status, ['Content-Type' => 'application/json'], $body);
    }

    protected function emptyResponse(int $status = 200): Response
    {
        return new Response($status, [], '');
    }

    protected function jsonStringResponse(string $json, int $status = 200): Response
    {
        return new Response($status, ['Content-Type' => 'application/json'], $json);
    }

    protected function lastRequestUri(): string
    {
        $request = end($this->history)['request'];

        return (string) $request->getUri();
    }

    protected function lastRequestMethod(): string
    {
        return end($this->history)['request']->getMethod();
    }

    /**
     * @return array<string, mixed>
     */
    protected function lastRequestBody(): array
    {
        $stream = end($this->history)['request']->getBody();
        $stream->rewind();
        $body = $stream->getContents();

        return json_decode($body, true) ?? [];
    }
}
