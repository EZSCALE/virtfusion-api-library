<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class TrafficBlock
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $ip,
        public ?string $reason,
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
            ip: $data['ip'] ?? '',
            reason: $data['reason'] ?? null,
            raw: $data,
        );
    }
}
