<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class PaginatedResponse
{
    /**
     * @param array<mixed> $items
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public array $items,
        public int $currentPage,
        public int $lastPage,
        public int $perPage,
        public int $total,
        public array $raw = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     * @param callable(array<string, mixed>): mixed $itemFactory
     */
    public static function fromArray(array $data, callable $itemFactory): self
    {
        $items = array_map($itemFactory, $data['data'] ?? []);

        return new self(
            items: $items,
            currentPage: $data['current_page'] ?? $data['meta']['current_page'] ?? 1,
            lastPage: $data['last_page'] ?? $data['meta']['last_page'] ?? 1,
            perPage: $data['per_page'] ?? $data['meta']['per_page'] ?? 15,
            total: $data['total'] ?? $data['meta']['total'] ?? count($items),
            raw: $data,
        );
    }
}
