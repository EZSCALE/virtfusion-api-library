<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\DataObjects\User;
use EZScale\VirtFusion\Tests\TestCase;

class UsersBuilderTest extends TestCase
{
    public function test_create_returns_user(): void
    {
        $vf = $this->mockClient($this->jsonResponse('user.json'));

        $user = $vf->users()->create(['name' => 'John Doe', 'email' => 'john@example.com']);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame(1, $user->id);
        $this->assertSame('John Doe', $user->name);
        $this->assertSame('john@example.com', $user->email);
        $this->assertSame('POST', $this->lastRequestMethod());
    }

    public function test_get_by_ext_relation(): void
    {
        $vf = $this->mockClient($this->jsonResponse('user.json'));

        $user = $vf->users()->getByExtRelation('100');

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame(100, $user->extRelationId);
        $this->assertStringContainsString('/users/100/byExtRelation', $this->lastRequestUri());
    }

    public function test_update_by_ext_relation(): void
    {
        $vf = $this->mockClient($this->emptyResponse(201));

        $vf->users()->updateByExtRelation('100', ['name' => 'Jane']);

        $this->assertSame('PUT', $this->lastRequestMethod());
        $this->assertSame('Jane', $this->lastRequestBody()['name']);
    }

    public function test_delete_by_ext_relation(): void
    {
        $vf = $this->mockClient($this->emptyResponse(204));

        $vf->users()->deleteByExtRelation('100');

        $this->assertSame('DELETE', $this->lastRequestMethod());
    }

    public function test_reset_password(): void
    {
        $vf = $this->mockClient($this->jsonResponse('user-password-reset.json'));

        $result = $vf->users()->resetPasswordByExtRelation('100');

        $this->assertSame('newpass456', $result['password']);
        $this->assertStringContainsString('/byExtRelation/resetPassword', $this->lastRequestUri());
    }

    public function test_authentication_tokens(): void
    {
        $vf = $this->mockClient($this->jsonResponse('auth-tokens.json'));

        $result = $vf->users()->authenticationTokens('100');

        $this->assertArrayHasKey('authentication', $result);
        $this->assertSame('token-abc', $result['authentication']['tokens']['1']);
    }

    public function test_server_authentication_tokens(): void
    {
        $vf = $this->mockClient($this->jsonResponse('auth-tokens.json'));

        $result = $vf->users()->serverAuthenticationTokens('100', 69);

        $this->assertStringContainsString('/serverAuthenticationTokens/69', $this->lastRequestUri());
    }
}
