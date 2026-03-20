<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\DataObjects;

readonly class ActionResult
{
    /**
     * @param array<string, mixed> $raw
     */
    public function __construct(
        public bool $success,
        public string $message,
        public array $raw = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            success: ($data['success'] ?? true) === true,
            message: $data['message'] ?? '',
            raw: $data,
        );
    }
}
