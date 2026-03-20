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
        $this->assertStringContainsString('/servers/69/power/boot', $this->lastRequestUri());
    }

    public function test_shutdown(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->shutdown();

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/power/shutdown', $this->lastRequestUri());
    }

    public function test_restart(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->restart();

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/power/restart', $this->lastRequestUri());
    }

    public function test_power_off(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->powerOff();

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/power/poweroff', $this->lastRequestUri());
    }

    public function test_delete_with_delay(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->delete(delay: 30);

        $this->assertTrue($result->success);
        $this->assertSame('DELETE', $this->lastRequestMethod());
        $this->assertStringContainsString('delay=30', $this->lastRequestUri());
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
        $this->assertSame('PUT', $this->lastRequestMethod());
        $this->assertStringContainsString('/servers/69/package/5', $this->lastRequestUri());
    }

    public function test_modify_backup_plan(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->modifyBackupPlan(2);

        $this->assertTrue($result->success);
        $this->assertSame('PUT', $this->lastRequestMethod());
        $this->assertStringContainsString('/servers/69/backups/plan/2', $this->lastRequestUri());
    }

    public function test_add_to_whitelist(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->addToWhitelist(['ips' => ['1.2.3.4']]);

        $this->assertTrue($result->success);
        $this->assertSame('POST', $this->lastRequestMethod());
        $this->assertStringContainsString('/servers/69/networkWhitelist', $this->lastRequestUri());
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
        $this->assertStringContainsString('/servers/69/ipv4Qty', $this->lastRequestUri());
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
        $this->assertStringContainsString('/servers/69/modify/traffic', $this->lastRequestUri());
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

    public function test_suspend(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->suspend();

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/suspend', $this->lastRequestUri());
    }

    public function test_unsuspend(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->unsuspend();

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/unsuspend', $this->lastRequestUri());
    }

    public function test_modify_name(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->modifyName('new-name');

        $this->assertTrue($result->success);
        $this->assertSame('new-name', $this->lastRequestBody()['name']);
        $this->assertStringContainsString('/servers/69/modify/name', $this->lastRequestUri());
    }

    public function test_modify_cpu_cores(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->modifyCpuCores(4);

        $this->assertTrue($result->success);
        $this->assertSame(4, $this->lastRequestBody()['cores']);
    }

    public function test_modify_cpu_throttle(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->modifyCpuThrottle(50, sync: true);

        $this->assertTrue($result->success);
        $this->assertSame(50, $this->lastRequestBody()['percent']);
    }

    public function test_modify_memory(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->modifyMemory(2048);

        $this->assertTrue($result->success);
        $this->assertSame(2048, $this->lastRequestBody()['memory']);
    }

    public function test_change_owner(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->changeOwner(42);

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/owner/42', $this->lastRequestUri());
    }

    public function test_reset_password(): void
    {
        $vf = $this->mockClient($this->jsonResponse('reset-password.json'));

        $result = $vf->server(69)->resetPassword('root', false);

        $this->assertSame(42, $result['queueId']);
        $this->assertSame('newpass123', $result['expectedPassword']);
        $this->assertSame('root', $this->lastRequestBody()['user']);
    }

    public function test_custom_xml(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->customXml(['domain' => '<xml/>']);

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/servers/69/customXML', $this->lastRequestUri());
    }

    public function test_traffic(): void
    {
        $vf = $this->mockClient($this->jsonResponse('traffic-stats.json'));

        $result = $vf->server(69)->traffic();

        $this->assertArrayHasKey('monthly', $result);
        $this->assertStringContainsString('/servers/69/traffic', $this->lastRequestUri());
    }

    public function test_vnc(): void
    {
        $vf = $this->mockClient($this->jsonResponse('vnc.json'));

        $result = $vf->server(69)->vnc();

        $this->assertArrayHasKey('vnc', $result);
        $this->assertTrue($result['vnc']['enabled']);
    }

    public function test_enable_vnc(): void
    {
        $vf = $this->mockClient($this->jsonResponse('vnc.json'));

        $result = $vf->server(69)->enableVnc();

        $this->assertSame('enable', $this->lastRequestBody()['action']);
    }

    public function test_disable_vnc(): void
    {
        $vf = $this->mockClient($this->jsonResponse('vnc.json'));

        $result = $vf->server(69)->disableVnc();

        $this->assertSame('disable', $this->lastRequestBody()['action']);
    }
}
