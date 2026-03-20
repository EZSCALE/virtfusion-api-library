<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\DataObjects\ActionResult;
use EZScale\VirtFusion\DataObjects\FirewallConfig;
use EZScale\VirtFusion\DataObjects\FirewallRule;
use EZScale\VirtFusion\Tests\TestCase;

class ServerFirewallBuilderTest extends TestCase
{
    public function test_get_returns_firewall_config(): void
    {
        $vf = $this->mockClient($this->jsonResponse('firewall-config.json'));

        $config = $vf->server(69)->firewall('primary')->get();

        $this->assertInstanceOf(FirewallConfig::class, $config);
        $this->assertTrue($config->enabled);
        $this->assertSame('primary', $config->interface);
        $this->assertCount(2, $config->rules);
        $this->assertInstanceOf(FirewallRule::class, $config->rules[0]);
        $this->assertSame(1, $config->rules[0]->id);
        $this->assertSame('accept', $config->rules[0]->action);
        $this->assertSame('tcp', $config->rules[0]->protocol);
        $this->assertSame('22', $config->rules[0]->port);
        $this->assertNull($config->rules[0]->source);
        $this->assertSame('0.0.0.0/0', $config->rules[1]->source);
        $this->assertStringContainsString('/servers/69/firewall/primary', $this->lastRequestUri());
    }

    public function test_enable(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->firewall('primary')->enable();

        $this->assertInstanceOf(ActionResult::class, $result);
        $this->assertTrue($result->success);
        $this->assertStringContainsString('/firewall/primary/enable', $this->lastRequestUri());
    }

    public function test_disable(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->firewall('primary')->disable();

        $this->assertTrue($result->success);
        $this->assertStringContainsString('/firewall/primary/disable', $this->lastRequestUri());
    }

    public function test_apply_rules(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->firewall('primary')->applyRules([1, 2, 5]);

        $this->assertTrue($result->success);
        $this->assertSame([1, 2, 5], $this->lastRequestBody()['rules']);
        $this->assertStringContainsString('/firewall/primary/rules', $this->lastRequestUri());
    }

    public function test_invalid_interface_name_throws(): void
    {
        $vf = $this->mockClient();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid interface name');

        $vf->server(69)->firewall('../../admin');
    }
}
