<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\Tests\TestCase;

class DnsBuilderTest extends TestCase
{
    public function test_get_service(): void
    {
        $vf = $this->mockClient($this->jsonStringResponse('{"data": {"id": 1, "name": "PowerDNS", "type": 1}}'));

        $result = $vf->dns()->getService(1);

        $this->assertSame(1, $result['id']);
        $this->assertSame('PowerDNS', $result['name']);
        $this->assertStringContainsString('/dns/services/1', $this->lastRequestUri());
    }
}
