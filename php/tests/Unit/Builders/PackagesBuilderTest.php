<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\DataObjects\Package;
use EZScale\VirtFusion\Tests\TestCase;

class PackagesBuilderTest extends TestCase
{
    public function test_list_returns_packages(): void
    {
        $vf = $this->mockClient($this->jsonResponse('packages.json'));

        $packages = $vf->packages()->list();

        $this->assertCount(2, $packages);
        $this->assertInstanceOf(Package::class, $packages[0]);
        $this->assertSame(1, $packages[0]->id);
        $this->assertSame('Starter', $packages[0]->name);
        $this->assertSame(1024, $packages[0]->memory);
        $this->assertSame(1, $packages[0]->cpuCores);
        $this->assertNull($packages[1]->description);
    }

    public function test_get_returns_package(): void
    {
        $vf = $this->mockClient($this->jsonResponse('package.json'));

        $pkg = $vf->packages()->get(1);

        $this->assertInstanceOf(Package::class, $pkg);
        $this->assertSame(1, $pkg->id);
        $this->assertSame('Basic plan', $pkg->description);
        $this->assertSame(20, $pkg->primaryStorage);
        $this->assertStringContainsString('/packages/1', $this->lastRequestUri());
    }
}
