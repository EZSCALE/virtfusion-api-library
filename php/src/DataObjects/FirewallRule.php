<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class FirewallRule
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $action,
        public string $protocol,
        public ?string $port,
        public ?string $source,
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
            action: $data['action'] ?? '',
            protocol: $data['protocol'] ?? '',
            port: $data['port'] ?? null,
            source: $data['source'] ?? null,
            raw: $data,
        );
    }
}
