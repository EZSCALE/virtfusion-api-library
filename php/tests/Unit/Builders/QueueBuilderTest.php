<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\Tests\TestCase;

class QueueBuilderTest extends TestCase
{
    public function test_get_queue_item(): void
    {
        $vf = $this->mockClient($this->jsonResponse('queue.json'));

        $result = $vf->queue()->get(42);

        $this->assertSame(42, $result['id']);
        $this->assertSame('ServerBuild', $result['job']);
        $this->assertSame(75, $result['progress']);
        $this->assertFalse($result['failed']);
        $this->assertStringContainsString('/queue/42', $this->lastRequestUri());
    }
}
