<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Exceptions;

class ValidationException extends VirtFusionException
{
    /** @param array<string, mixed> $errors */
    public function __construct(
        string $message,
        private readonly array $errors = [],
        int $code = 422,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    /** @return array<string, mixed> */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
