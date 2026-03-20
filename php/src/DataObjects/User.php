<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class User
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public int|string|null $extRelationId,
        public bool $suspended,
        public int $selfService,
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
            email: $data['email'] ?? '',
            extRelationId: $data['extRelationId'] ?? null,
            suspended: $data['suspended'] ?? false,
            selfService: $data['selfService'] ?? 0,
            raw: $data,
        );
    }
}
