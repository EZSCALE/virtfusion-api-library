<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\DataObjects\HypervisorGroup;
use EZScale\VirtFusion\DataObjects\HypervisorGroupResource;
use EZScale\VirtFusion\DataObjects\PaginatedResponse;
use EZScale\VirtFusion\Tests\TestCase;

class HypervisorGroupBuilderTest extends TestCase
{
    public function test_get_returns_hypervisor_group(): void
    {
        $vf = $this->mockClient($this->jsonResponse('hypervisor-group.json'));

        $group = $vf->hypervisorGroups()->group(3)->get();

        $this->assertInstanceOf(HypervisorGroup::class, $group);
        $this->assertSame(3, $group->id);
        $this->assertSame('AP South', $group->name);
        $this->assertSame('Asia Pacific cluster', $group->description);
        $this->assertStringContainsString('/compute/hypervisors/groups/3', $this->lastRequestUri());
    }

    public function test_resources_returns_paginated_response(): void
    {
        $vf = $this->mockClient($this->jsonResponse('hypervisor-group-resources.json'));

        $response = $vf->hypervisorGroups()->group(3)->resources();

        $this->assertInstanceOf(PaginatedResponse::class, $response);
        $this->assertCount(2, $response->items);
        $this->assertInstanceOf(HypervisorGroupResource::class, $response->items[0]);
        $this->assertSame(10, $response->items[0]->id);
        $this->assertSame('storage', $response->items[0]->type);
        $this->assertSame('SSD Pool 1', $response->items[0]->name);
        $this->assertStringContainsString('/compute/hypervisors/groups/3/resources', $this->lastRequestUri());
    }
}
