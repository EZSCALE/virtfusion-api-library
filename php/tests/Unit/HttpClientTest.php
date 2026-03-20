<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit;

use EZScale\VirtFusion\Exceptions\VirtFusionException;
use EZScale\VirtFusion\HttpClient;
use EZScale\VirtFusion\Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class HttpClientTest extends TestCase
{
    public function test_request_returns_decoded_json(): void
    {
        $http = $this->mockHttp(
            $this->jsonStringResponse('{"data": {"id": 1}}'),
        );

        $result = $http->request('GET', 'test');

        $this->assertSame(['data' => ['id' => 1]], $result);
    }

    public function test_empty_response_returns_empty_array(): void
    {
        $http = $this->mockHttp($this->emptyResponse());

        $result = $http->request('GET', 'test');

        $this->assertSame([], $result);
    }

    public function test_constructor_creates_default_client(): void
    {
        $http = new HttpClient('https://cp.test.com', 'test-token');

        $this->assertInstanceOf(HttpClient::class, $http);
    }

    public function test_connect_exception_throws_virtfusion_exception(): void
    {
        $mock = new MockHandler([
            new ConnectException(
                'Connection refused',
                new Request('GET', 'test'),
            ),
        ]);
        $client = new Client(['handler' => HandlerStack::create($mock)]);
        $http = new HttpClient('https://cp.test.com', 'test-token', $client);

        $this->expectException(VirtFusionException::class);
        $this->expectExceptionMessage('Failed to connect to VirtFusion API');

        $http->request('GET', 'test');
    }

    public function test_invalid_json_response_throws_virtfusion_exception(): void
    {
        $http = $this->mockHttp(
            new Response(200, [], 'not valid json'),
        );

        $this->expectException(VirtFusionException::class);
        $this->expectExceptionMessage('Failed to decode API response');

        $http->request('GET', 'test');
    }
}
