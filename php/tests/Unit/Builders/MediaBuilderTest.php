<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\Tests\TestCase;

class MediaBuilderTest extends TestCase
{
    public function test_get_iso(): void
    {
        $vf = $this->mockClient($this->jsonStringResponse('{"data": {"id": 1, "name": "Ubuntu 22.04"}}'));

        $result = $vf->media()->getIso(1);

        $this->assertSame(1, $result['id']);
        $this->assertStringContainsString('/media/iso/1', $this->lastRequestUri());
    }

    public function test_templates_from_package_spec(): void
    {
        $vf = $this->mockClient($this->jsonStringResponse('{"data": [{"name": "Ubuntu", "templates": []}]}'));

        $result = $vf->media()->templatesFromPackageSpec(5);

        $this->assertCount(1, $result);
        $this->assertSame('Ubuntu', $result[0]['name']);
        $this->assertStringContainsString('/media/templates/fromServerPackageSpec/5', $this->lastRequestUri());
    }
}
