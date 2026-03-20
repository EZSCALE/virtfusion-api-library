<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class Backup
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public int $serverId,
        public bool $complete,
        public bool $restoring,
        public bool $deleting,
        public array $raw = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            serverId: $data['serverId'] ?? 0,
            complete: $data['complete'] ?? false,
            restoring: $data['restoring'] ?? false,
            deleting: $data['deleting'] ?? false,
            raw: $data,
        );
    }
}
