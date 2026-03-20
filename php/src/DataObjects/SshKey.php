<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class SshKey
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $name,
        public ?string $publicKey,
        public string $type,
        public bool $enabled,
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
            publicKey: $data['publicKey'] ?? null,
            type: $data['type'] ?? '',
            enabled: $data['enabled'] ?? true,
            raw: $data,
        );
    }
}
