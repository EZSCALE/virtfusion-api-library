<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\DataObjects\SshKey;
use EZScale\VirtFusion\Tests\TestCase;

class SshKeysBuilderTest extends TestCase
{
    public function test_create_returns_ssh_key(): void
    {
        $vf = $this->mockClient($this->jsonResponse('ssh-key.json'));

        $key = $vf->sshKeys()->create(1, 'my-key', 'ssh-rsa AAAA...');

        $this->assertInstanceOf(SshKey::class, $key);
        $this->assertSame(1, $key->id);
        $this->assertSame('my-key', $key->name);
        $this->assertSame('POST', $this->lastRequestMethod());
    }

    public function test_get_returns_ssh_key(): void
    {
        $vf = $this->mockClient($this->jsonResponse('ssh-key.json'));

        $key = $vf->sshKeys()->get(1);

        $this->assertSame('rsa', $key->type);
        $this->assertTrue($key->enabled);
        $this->assertStringContainsString('/ssh_keys/1', $this->lastRequestUri());
    }

    public function test_list_by_user(): void
    {
        $vf = $this->mockClient($this->jsonResponse('ssh-keys.json'));

        $keys = $vf->sshKeys()->listByUser(1);

        $this->assertCount(2, $keys);
        $this->assertInstanceOf(SshKey::class, $keys[0]);
        $this->assertStringContainsString('/ssh_keys/user/1', $this->lastRequestUri());
    }

    public function test_delete(): void
    {
        $vf = $this->mockClient($this->emptyResponse(204));

        $vf->sshKeys()->delete(1);

        $this->assertSame('DELETE', $this->lastRequestMethod());
        $this->assertStringContainsString('/ssh_keys/1', $this->lastRequestUri());
    }
}
