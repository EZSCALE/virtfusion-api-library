<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\DataObjects\ActionResult;
use EZScale\VirtFusion\DataObjects\TrafficBlock;
use EZScale\VirtFusion\Tests\TestCase;

class ServerTrafficBlocksBuilderTest extends TestCase
{
    public function test_list_returns_traffic_blocks(): void
    {
        $vf = $this->mockClient($this->jsonResponse('traffic-blocks.json'));

        $blocks = $vf->server(69)->trafficBlocks()->list();

        $this->assertCount(2, $blocks);
        $this->assertInstanceOf(TrafficBlock::class, $blocks[0]);
        $this->assertSame(42, $blocks[0]->id);
        $this->assertSame('1.2.3.4', $blocks[0]->ip);
        $this->assertSame('Abuse', $blocks[0]->reason);
        $this->assertNull($blocks[1]->reason);
        $this->assertStringContainsString('/servers/69/traffic-blocks', $this->lastRequestUri());
    }

    public function test_add(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->trafficBlocks()->add(['ip' => '1.2.3.4']);

        $this->assertInstanceOf(ActionResult::class, $result);
        $this->assertTrue($result->success);
        $this->assertSame('POST', $this->lastRequestMethod());
        $this->assertSame('1.2.3.4', $this->lastRequestBody()['ip']);
    }

    public function test_remove(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->server(69)->trafficBlocks()->remove(42);

        $this->assertTrue($result->success);
        $this->assertSame('DELETE', $this->lastRequestMethod());
        $this->assertStringContainsString('/traffic-blocks/42', $this->lastRequestUri());
    }
}
