<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\DataObjects\IpBlock;
use EZScale\VirtFusion\DataObjects\PaginatedResponse;
use EZScale\VirtFusion\Tests\TestCase;

class IpBlocksBuilderTest extends TestCase
{
    public function test_list_returns_paginated(): void
    {
        $vf = $this->mockClient($this->jsonResponse('ip-blocks.json'));

        $response = $vf->ipBlocks()->list();

        $this->assertInstanceOf(PaginatedResponse::class, $response);
        $this->assertCount(1, $response->items);
        $this->assertInstanceOf(IpBlock::class, $response->items[0]);
        $this->assertSame('Primary Block', $response->items[0]->name);
        $this->assertStringContainsString('/connectivity/ipblocks', $this->lastRequestUri());
    }

    public function test_get_returns_ip_block(): void
    {
        $vf = $this->mockClient($this->jsonResponse('ip-block.json'));

        $block = $vf->ipBlocks()->get(1);

        $this->assertInstanceOf(IpBlock::class, $block);
        $this->assertSame(1, $block->id);
        $this->assertSame('10.0.0.1', $block->ipv4['gateway']);
    }

    public function test_add_ipv4_range(): void
    {
        $vf = $this->mockClient($this->jsonResponse('action-success.json'));

        $result = $vf->ipBlocks()->addIpv4Range(1, '10.0.0.10', '10.0.0.20');

        $this->assertTrue($result->success);
        $this->assertSame('range', $this->lastRequestBody()['type']);
        $this->assertSame('10.0.0.10', $this->lastRequestBody()['start']);
    }
}
