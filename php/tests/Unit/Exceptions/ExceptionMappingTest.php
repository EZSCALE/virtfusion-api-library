<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Exceptions;

use EZScale\VirtFusion\Exceptions\AuthenticationException;
use EZScale\VirtFusion\Exceptions\AuthorizationException;
use EZScale\VirtFusion\Exceptions\NotFoundException;
use EZScale\VirtFusion\Exceptions\RateLimitException;
use EZScale\VirtFusion\Exceptions\ServerException;
use EZScale\VirtFusion\Exceptions\ValidationException;
use EZScale\VirtFusion\Exceptions\VirtFusionException;
use EZScale\VirtFusion\Tests\TestCase;
use GuzzleHttp\Psr7\Response;

class ExceptionMappingTest extends TestCase
{
    public function test_401_throws_authentication_exception(): void
    {
        $http = $this->mockHttp($this->jsonResponse('error-401.json', 401));

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Unauthenticated');

        $http->request('GET', 'test');
    }

    public function test_403_throws_authorization_exception(): void
    {
        $http = $this->mockHttp($this->jsonResponse('error-403.json', 403));

        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('Forbidden');

        $http->request('GET', 'test');
    }

    public function test_404_throws_not_found_exception(): void
    {
        $http = $this->mockHttp($this->jsonResponse('error-404.json', 404));

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Not found');

        $http->request('GET', 'test');
    }

    public function test_422_throws_validation_exception_with_errors(): void
    {
        $http = $this->mockHttp($this->jsonResponse('error-422.json', 422));

        try {
            $http->request('POST', 'test');
            $this->fail('Expected ValidationException');
        } catch (ValidationException $e) {
            $this->assertSame('Validation failed', $e->getMessage());
            $errors = $e->getErrors();
            $this->assertArrayHasKey('name', $errors);
            $this->assertArrayHasKey('packageId', $errors);
        }
    }

    public function test_429_throws_rate_limit_exception_with_retry_after(): void
    {
        $http = $this->mockHttp(
            new Response(429, [
                'Content-Type' => 'application/json',
                'Retry-After' => '30',
            ], '{"message": "Too many requests"}'),
        );

        try {
            $http->request('GET', 'test');
            $this->fail('Expected RateLimitException');
        } catch (RateLimitException $e) {
            $this->assertSame('Too many requests', $e->getMessage());
            $this->assertSame(30, $e->getRetryAfter());
        }
    }

    public function test_429_without_retry_after_header(): void
    {
        $http = $this->mockHttp(
            new Response(429, [
                'Content-Type' => 'application/json',
            ], '{"message": "Too many requests"}'),
        );

        try {
            $http->request('GET', 'test');
            $this->fail('Expected RateLimitException');
        } catch (RateLimitException $e) {
            $this->assertNull($e->getRetryAfter());
        }
    }

    public function test_500_throws_server_exception(): void
    {
        $http = $this->mockHttp($this->jsonResponse('error-500.json', 500));

        $this->expectException(ServerException::class);
        $this->expectExceptionMessage('Internal server error');

        $http->request('GET', 'test');
    }

    public function test_all_exceptions_extend_base(): void
    {
        $this->assertInstanceOf(VirtFusionException::class, new AuthenticationException('test'));
        $this->assertInstanceOf(VirtFusionException::class, new AuthorizationException('test'));
        $this->assertInstanceOf(VirtFusionException::class, new NotFoundException('test'));
        $this->assertInstanceOf(VirtFusionException::class, new ValidationException('test'));
        $this->assertInstanceOf(VirtFusionException::class, new RateLimitException('test'));
        $this->assertInstanceOf(VirtFusionException::class, new ServerException('test'));
    }
}
