<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class HypervisorGroupResource
{
    /**
     * @param array<string, mixed> $hypervisor
     * @param array<string, mixed> $resources
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $hypervisorId,
        public string $hypervisorName,
        public array $hypervisor,
        public array $resources,
        public array $raw = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $hv = $data['hypervisor'] ?? [];

        return new self(
            hypervisorId: $hv['id'] ?? $data['id'] ?? 0,
            hypervisorName: $hv['name'] ?? $data['name'] ?? '',
            hypervisor: $hv,
            resources: $data['resources'] ?? [],
            raw: $data,
        );
    }
}
