<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\Tests\TestCase;

class SelfServiceBuilderTest extends TestCase
{
    public function test_add_credit(): void
    {
        $vf = $this->mockClient($this->jsonStringResponse('{"data": {"id": 1}}'));

        $result = $vf->selfService()->addCredit('100', 50.0, 123, 'invoice-1');

        $this->assertSame(1, $result['id']);
        $this->assertEquals(50, $this->lastRequestBody()['tokens']);
        $this->assertSame(123, $this->lastRequestBody()['reference_1']);
        $this->assertStringContainsString('/selfService/credit/byUserExtRelationId/100', $this->lastRequestUri());
    }

    public function test_delete_credit(): void
    {
        $vf = $this->mockClient($this->emptyResponse(204));

        $vf->selfService()->deleteCredit(1);

        $this->assertSame('DELETE', $this->lastRequestMethod());
        $this->assertStringContainsString('/selfService/credit/1', $this->lastRequestUri());
    }

    public function test_currencies(): void
    {
        $vf = $this->mockClient($this->jsonStringResponse('{"data": [{"id": 1, "code": "USD"}]}'));

        $result = $vf->selfService()->currencies();

        $this->assertCount(1, $result);
        $this->assertSame('USD', $result[0]['code']);
    }

    public function test_add_hourly_group_profile(): void
    {
        $vf = $this->mockClient($this->emptyResponse(204));

        $vf->selfService()->addHourlyGroupProfile('100', 5);

        $this->assertSame(5, $this->lastRequestBody()['profileId']);
    }

    public function test_remove_hourly_group_profile(): void
    {
        $vf = $this->mockClient($this->emptyResponse(204));

        $vf->selfService()->removeHourlyGroupProfile(5, '100');

        $this->assertSame('DELETE', $this->lastRequestMethod());
        $this->assertStringContainsString('/hourlyGroupProfile/5/byUserExtRelationId/100', $this->lastRequestUri());
    }

    public function test_create_resource_pack(): void
    {
        $vf = $this->mockClient($this->jsonStringResponse('{"data": {"id": 10}}'));

        $result = $vf->selfService()->createResourcePack('100', 5);

        $this->assertSame(10, $result['id']);
        $this->assertSame(5, $this->lastRequestBody()['packId']);
    }

    public function test_get_resource_pack(): void
    {
        $vf = $this->mockClient($this->jsonStringResponse('{"data": {"id": 5, "name": "Basic Pack"}}'));

        $result = $vf->selfService()->getResourcePack(5, withServers: true);

        $this->assertSame('Basic Pack', $result['name']);
    }

    public function test_suspend_resource_pack_servers(): void
    {
        $vf = $this->mockClient($this->emptyResponse(204));

        $vf->selfService()->suspendResourcePackServers(5);

        $this->assertSame('POST', $this->lastRequestMethod());
        $this->assertStringContainsString('/resourcePackServers/5/suspend', $this->lastRequestUri());
    }

    public function test_usage(): void
    {
        $vf = $this->mockClient($this->jsonStringResponse('{"data": {"user": {"id": 1}}}'));

        $result = $vf->selfService()->usage('100');

        $this->assertArrayHasKey('user', $result);
        $this->assertStringContainsString('/selfService/usage/byUserExtRelationId/100', $this->lastRequestUri());
    }
}
