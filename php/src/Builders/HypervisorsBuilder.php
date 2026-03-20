<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\Hypervisor;
use EZScale\VirtFusion\DataObjects\PaginatedResponse;
use EZScale\VirtFusion\HttpClient;

class HypervisorsBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    public function list(int $results = 20): PaginatedResponse
    {
        $data = $this->http->request('GET', 'compute/hypervisors', [
            'query' => ['results' => $results],
        ]);

        return PaginatedResponse::fromArray(
            $data,
            fn(array $item) => Hypervisor::fromArray($item),
        );
    }

    public function get(int $hypervisorId): Hypervisor
    {
        $data = $this->http->request('GET', "compute/hypervisors/{$hypervisorId}");

        return Hypervisor::fromArray($data['data'] ?? $data);
    }

    public function groups(): HypervisorGroupsBuilder
    {
        return new HypervisorGroupsBuilder($this->http);
    }
}
