<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class HypervisorGroupResource
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $type,
        public string $name,
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
            type: $data['type'] ?? '',
            name: $data['name'] ?? '',
            raw: $data,
        );
    }
}
