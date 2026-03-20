<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Exceptions;

class RateLimitException extends VirtFusionException
{
    public function __construct(
        string $message,
        private readonly ?int $retryAfter = null,
        int $code = 429,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getRetryAfter(): ?int
    {
        return $this->retryAfter;
    }
}
