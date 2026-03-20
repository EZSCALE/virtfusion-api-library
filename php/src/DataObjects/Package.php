<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class Package
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $name,
        public ?string $description,
        public bool $enabled,
        public int $memory,
        public int $primaryStorage,
        public int $traffic,
        public int $cpuCores,
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
            enabled: $data['enabled'] ?? false,
            memory: $data['memory'] ?? 0,
            primaryStorage: $data['primaryStorage'] ?? 0,
            traffic: $data['traffic'] ?? 0,
            cpuCores: $data['cpuCores'] ?? 0,
            raw: $data,
        );
    }
}
