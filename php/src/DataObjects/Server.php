<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class Server
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $name,
        public ?string $hostname,
        public string $state,
        public ?int $packageId,
        public ?string $primaryIp,
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
            hostname: $data['hostname'] ?? null,
            state: $data['state'] ?? '',
            packageId: $data['packageId'] ?? $data['package_id'] ?? null,
            primaryIp: $data['primaryIp'] ?? $data['primary_ip'] ?? null,
            raw: $data,
        );
    }
}
