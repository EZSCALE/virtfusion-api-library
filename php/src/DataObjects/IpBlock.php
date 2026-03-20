<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class IpBlock
{
    /**
     * @param array<string, mixed> $ipv4
     * @param array<string, mixed> $ipv6
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $name,
        public int $type,
        public bool $enabled,
        public array $ipv4,
        public array $ipv6,
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
            name: $data['name'] ?? '',
            type: $data['type'] ?? 0,
            enabled: $data['enabled'] ?? false,
            ipv4: $data['ipv4'] ?? [],
            ipv6: $data['ipv6'] ?? [],
            raw: $data,
        );
    }
}
