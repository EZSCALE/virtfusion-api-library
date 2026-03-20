<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class Hypervisor
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $ip,
        public ?string $hostname,
        public bool $enabled,
        public bool $maintenance,
        public int $maxServers,
        public int $maxCpu,
        public int $maxMemory,
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
            ip: $data['ip'] ?? '',
            hostname: $data['hostname'] ?? null,
            enabled: $data['enabled'] ?? false,
            maintenance: $data['maintenance'] ?? false,
            maxServers: $data['maxServers'] ?? 0,
            maxCpu: $data['maxCpu'] ?? 0,
            maxMemory: $data['maxMemory'] ?? 0,
            raw: $data,
        );
    }
}
