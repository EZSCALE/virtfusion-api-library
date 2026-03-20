<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Tests\Unit\Builders;

use EZScale\VirtFusion\DataObjects\Backup;
use EZScale\VirtFusion\Tests\TestCase;

class BackupsBuilderTest extends TestCase
{
    public function test_list_by_server(): void
    {
        $vf = $this->mockClient($this->jsonResponse('backups.json'));

        $backups = $vf->backups()->listByServer(69);

        $this->assertCount(2, $backups);
        $this->assertInstanceOf(Backup::class, $backups[0]);
        $this->assertSame(1, $backups[0]->id);
        $this->assertTrue($backups[0]->complete);
        $this->assertFalse($backups[1]->complete);
        $this->assertStringContainsString('/backups/server/69', $this->lastRequestUri());
    }
}
