<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\HttpClient;

class QueueBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function get(int $queueId): array
    {
        $data = $this->http->request('GET', "queue/{$queueId}");

        return $data['data'] ?? $data;
    }
}
