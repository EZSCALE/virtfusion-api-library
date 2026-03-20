<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\Builders\ServerBuilder;
use EZScale\VirtFusion\Builders\ServerFirewallBuilder;
use EZScale\VirtFusion\Builders\ServerTrafficBlocksBuilder;
use EZScale\VirtFusion\DataObjects\ActionResult;
use EZScale\VirtFusion\DataObjects\Server;
use EZScale\VirtFusion\Tests\TestCase;

class ServerBuilderTest extends TestCase
{
    public function test_get_returns_server(): void
    {
        $vf = $this->mockClient($this->jsonResponse('server.json'));

        $server = $vf->server(69)->get();

        $this->assertInstanceOf(Server::class, $server);
        $this->assertSame(69, $server->id);
        $this->assertSame('web1', $server->name);
        $this->assertSame('web1.example.com', $server->hostname);
        $this->assertSame('running', $server->state);
        $this->assertSame(5, $server->packageId);
        $this->assertSame('10.0.0.1', $server->primaryIp);
        $this->assertStringContainsString('/servers/69', $this->lastRequestUri());
    }

    public function test_boot(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->boot();

        $this->assertInstanceOf(ActionResult::class, $result);
        $this->assertTrue($result->success);
        $this->assertSame('POST', $this->lastRequestMethod());
        $this->assertStringContainsString('/servers/69/boot', $this->lastRequestUri());
    }

    public function test_shutdown(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->shutdown();

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/shutdown', $this->lastRequestUri());
    }

    public function test_restart(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->restart();

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/restart', $this->lastRequestUri());
    }

    public function test_power_off(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->powerOff();

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/power-off', $this->lastRequestUri());
    }

    public function test_delete_with_delay(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->delete(delay: 30);

        $this->assertTrue($result->success);
        $this->assertSame('DELETE', $this->lastRequestMethod());
        $this->assertSame(30, $this->lastRequestBody()['delay']);
    }

    public function test_build(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->build(['reinstall' => true]);

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/build', $this->lastRequestUri());
        $this->assertTrue($this->lastRequestBody()['reinstall']);
    }

    public function test_change_package(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->changePackage(5);

        $this->assertTrue($result->success);
        $this->assertSame(5, $this->lastRequestBody()['packageId']);
    }

    public function test_modify_backup_plan(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->modifyBackupPlan(2);

        $this->assertTrue($result->success);
        $this->assertSame(2, $this->lastRequestBody()['planId']);
    }

    public function test_add_to_whitelist(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->addToWhitelist(['ips' => ['1.2.3.4']]);

        $this->assertTrue($result->success);
        $this->assertSame('POST', $this->lastRequestMethod());
        $this->assertStringContainsString('/servers/69/whitelist', $this->lastRequestUri());
    }

    public function test_remove_from_whitelist(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->removeFromWhitelist(['ips' => ['1.2.3.4']]);

        $this->assertTrue($result->success);
        $this->assertSame('DELETE', $this->lastRequestMethod());
    }

    public function test_add_ipv4(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->addIpv4(['ips' => ['10.0.0.2']]);

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/ipv4', $this->lastRequestUri());
    }

    public function test_add_ipv4_quantity(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->addIpv4Quantity(['quantity' => 2]);

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/ipv4/quantity', $this->lastRequestUri());
    }

    public function test_remove_ipv4(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->removeIpv4(['ips' => ['10.0.0.2']]);

        $this->assertTrue($result->success);
        $this->assertSame('DELETE', $this->lastRequestMethod());
    }

    public function test_modify_traffic(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->modifyTraffic(['limit' => 1000]);

        $this->assertTrue($result->success);
        $this->assertSame('PUT', $this->lastRequestMethod());
        $this->assertStringContainsString('/servers/69/traffic', $this->lastRequestUri());
    }

    public function test_firewall_returns_sub_builder(): void
    {
        $vf = $this->mockClient();

        $builder = $vf->server(69)->firewall('primary');

        $this->assertInstanceOf(ServerFirewallBuilder::class, $builder);
    }

    public function test_traffic_blocks_returns_sub_builder(): void
    {
        $vf = $this->mockClient();

        $builder = $vf->server(69)->trafficBlocks();

        $this->assertInstanceOf(ServerTrafficBlocksBuilder::class, $builder);
    }

    public function test_server_raw_array_available(): void
    {
        $vf = $this->mockClient($this->jsonResponse('server.json'));

        $server = $vf->server(69)->get();

        $this->assertArrayHasKey('id', $server->raw);
    }
}
