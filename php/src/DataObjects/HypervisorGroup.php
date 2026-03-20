<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class HypervisorGroup
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $name,
        public ?string $description,
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
            description: $data['description'] ?? null,
            raw: $data,
        );
    }
}
