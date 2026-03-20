<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit;

use EZScale\VirtFusion\Builders\BackupsBuilder;
use EZScale\VirtFusion\Builders\DnsBuilder;
use EZScale\VirtFusion\Builders\HypervisorGroupsBuilder;
use EZScale\VirtFusion\Builders\HypervisorsBuilder;
use EZScale\VirtFusion\Builders\IpBlocksBuilder;
use EZScale\VirtFusion\Builders\MediaBuilder;
use EZScale\VirtFusion\Builders\PackagesBuilder;
use EZScale\VirtFusion\Builders\QueueBuilder;
use EZScale\VirtFusion\Builders\SelfServiceBuilder;
use EZScale\VirtFusion\Builders\ServerBuilder;
use EZScale\VirtFusion\Builders\SshKeysBuilder;
use EZScale\VirtFusion\Builders\UsersBuilder;
use EZScale\VirtFusion\DataObjects\ConnectionTestResult;
use EZScale\VirtFusion\DataObjects\Server;
use EZScale\VirtFusion\DataObjects\ServerCreated;
use EZScale\VirtFusion\Tests\TestCase;

class VirtFusionTest extends TestCase
{
    public function test_test_connection_returns_result(): void
    {
        $vf = $this->mockClient($this->jsonResponse('connect.json'));

        $result = $vf->testConnection();

        $this->assertInstanceOf(ConnectionTestResult::class, $result);
        $this->assertTrue($result->success);
        $this->assertSame('Connection successful', $result->message);
        $this->assertStringContainsString('/connect', $this->lastRequestUri());
    }

    public function test_server_returns_builder(): void
    {
        $vf = $this->mockClient();
        $this->assertInstanceOf(ServerBuilder::class, $vf->server(69));
    }

    public function test_create_server(): void
    {
        $vf = $this->mockClient($this->jsonResponse('server-created.json'));

        $result = $vf->createServer(['packageId' => 1, 'name' => 'web2']);

        $this->assertInstanceOf(ServerCreated::class, $result);
        $this->assertSame(70, $result->id);
        $this->assertSame('POST', $this->lastRequestMethod());
    }

    public function test_list_servers(): void
    {
        $vf = $this->mockClient($this->jsonResponse('servers-list.json'));

        $servers = $vf->listServers();

        $this->assertCount(2, $servers);
        $this->assertInstanceOf(Server::class, $servers[0]);
        $this->assertStringContainsString('/servers', $this->lastRequestUri());
    }

    public function test_list_servers_by_user(): void
    {
        $vf = $this->mockClient($this->jsonResponse('servers-list.json'));

        $servers = $vf->listServersByUser(1);

        $this->assertCount(2, $servers);
        $this->assertStringContainsString('/servers/user/1', $this->lastRequestUri());
    }

    public function test_builder_factory_methods(): void
    {
        $vf = $this->mockClient();

        $this->assertInstanceOf(HypervisorGroupsBuilder::class, $vf->hypervisorGroups());
        $this->assertInstanceOf(HypervisorsBuilder::class, $vf->hypervisors());
        $this->assertInstanceOf(PackagesBuilder::class, $vf->packages());
        $this->assertInstanceOf(UsersBuilder::class, $vf->users());
        $this->assertInstanceOf(SshKeysBuilder::class, $vf->sshKeys());
        $this->assertInstanceOf(IpBlocksBuilder::class, $vf->ipBlocks());
        $this->assertInstanceOf(BackupsBuilder::class, $vf->backups());
        $this->assertInstanceOf(DnsBuilder::class, $vf->dns());
        $this->assertInstanceOf(MediaBuilder::class, $vf->media());
        $this->assertInstanceOf(QueueBuilder::class, $vf->queue());
        $this->assertInstanceOf(SelfServiceBuilder::class, $vf->selfService());
    }
}
