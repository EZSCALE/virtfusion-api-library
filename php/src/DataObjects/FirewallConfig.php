<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class FirewallConfig
{
    /**
     * @param FirewallRule[] $rules
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public bool $enabled,
        public string $interface,
        public array $rules,
        public array $raw = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $rules = array_map(
            fn(array $rule) => FirewallRule::fromArray($rule),
            $data['rules'] ?? [],
        );

        return new self(
            enabled: $data['enabled'] ?? false,
            interface: $data['interface'] ?? '',
            rules: $rules,
            raw: $data,
        );
    }
}
