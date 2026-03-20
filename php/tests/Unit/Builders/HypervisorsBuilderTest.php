<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\Builders\HypervisorGroupsBuilder;
use EZScale\VirtFusion\DataObjects\Hypervisor;
use EZScale\VirtFusion\DataObjects\PaginatedResponse;
use EZScale\VirtFusion\Tests\TestCase;

class HypervisorsBuilderTest extends TestCase
{
    public function test_list_returns_paginated_response(): void
    {
        $vf = $this->mockClient($this->jsonResponse('hypervisors.json'));

        $response = $vf->hypervisors()->list();

        $this->assertInstanceOf(PaginatedResponse::class, $response);
        $this->assertCount(1, $response->items);
        $this->assertInstanceOf(Hypervisor::class, $response->items[0]);
        $this->assertSame(1, $response->items[0]->id);
        $this->assertSame('hv-us-1', $response->items[0]->name);
        $this->assertTrue($response->items[0]->enabled);
        $this->assertFalse($response->items[0]->maintenance);
        $this->assertStringContainsString('/compute/hypervisors', $this->lastRequestUri());
    }

    public function test_get_returns_hypervisor(): void
    {
        $vf = $this->mockClient($this->jsonResponse('hypervisor.json'));

        $hv = $vf->hypervisors()->get(1);

        $this->assertInstanceOf(Hypervisor::class, $hv);
        $this->assertSame(1, $hv->id);
        $this->assertSame('10.1.0.1', $hv->ip);
        $this->assertSame(50, $hv->maxServers);
        $this->assertStringContainsString('/compute/hypervisors/1', $this->lastRequestUri());
    }

    public function test_groups_returns_builder(): void
    {
        $vf = $this->mockClient();

        $builder = $vf->hypervisors()->groups();

        $this->assertInstanceOf(HypervisorGroupsBuilder::class, $builder);
    }
}
