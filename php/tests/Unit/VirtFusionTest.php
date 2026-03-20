<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit;

use EZScale\VirtFusion\Builders\HypervisorGroupsBuilder;
use EZScale\VirtFusion\Builders\ServerBuilder;
use EZScale\VirtFusion\DataObjects\ConnectionTestResult;
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

        $builder = $vf->server(69);

        $this->assertInstanceOf(ServerBuilder::class, $builder);
    }

    public function test_create_server(): void
    {
        $vf = $this->mockClient($this->jsonResponse('server-created.json'));

        $result = $vf->createServer(['packageId' => 1, 'name' => 'web2']);

        $this->assertInstanceOf(ServerCreated::class, $result);
        $this->assertSame(70, $result->id);
        $this->assertSame('web2', $result->name);
        $this->assertSame('POST', $this->lastRequestMethod());
        $this->assertStringContainsString('/servers', $this->lastRequestUri());
    }

    public function test_hypervisor_groups_returns_builder(): void
    {
        $vf = $this->mockClient();

        $builder = $vf->hypervisorGroups();

        $this->assertInstanceOf(HypervisorGroupsBuilder::class, $builder);
    }
}
