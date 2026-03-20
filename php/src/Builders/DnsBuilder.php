<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\HttpClient;

class DnsBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function getService(int $serviceId): array
    {
        $data = $this->http->request('GET', "dns/services/{$serviceId}");

        return $data['data'] ?? $data;
    }
}
