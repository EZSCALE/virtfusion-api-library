<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\Builders\HypervisorGroupBuilder;
use EZScale\VirtFusion\DataObjects\HypervisorGroup;
use EZScale\VirtFusion\DataObjects\PaginatedResponse;
use EZScale\VirtFusion\Tests\TestCase;

class HypervisorGroupsBuilderTest extends TestCase
{
    public function test_list_returns_paginated_response(): void
    {
        $vf = $this->mockClient($this->jsonResponse('hypervisor-groups.json'));

        $response = $vf->hypervisorGroups()->list();

        $this->assertInstanceOf(PaginatedResponse::class, $response);
        $this->assertCount(2, $response->items);
        $this->assertInstanceOf(HypervisorGroup::class, $response->items[0]);
        $this->assertSame(1, $response->items[0]->id);
        $this->assertSame('US East', $response->items[0]->name);
        $this->assertSame('US East Coast cluster', $response->items[0]->description);
        $this->assertNull($response->items[1]->description);
        $this->assertSame(1, $response->currentPage);
        $this->assertSame(1, $response->lastPage);
        $this->assertSame(15, $response->perPage);
        $this->assertSame(2, $response->total);
    }

    public function test_group_returns_builder(): void
    {
        $vf = $this->mockClient();

        $builder = $vf->hypervisorGroups()->group(3);

        $this->assertInstanceOf(HypervisorGroupBuilder::class, $builder);
    }
}
