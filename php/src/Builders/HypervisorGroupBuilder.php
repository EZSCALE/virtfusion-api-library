<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\HypervisorGroup;
use EZScale\VirtFusion\DataObjects\HypervisorGroupResource;
use EZScale\VirtFusion\DataObjects\PaginatedResponse;
use EZScale\VirtFusion\HttpClient;

class HypervisorGroupBuilder
{
    public function __construct(
        private readonly HttpClient $http,
        private readonly int $groupId,
    ) {
    }

    public function get(): HypervisorGroup
    {
        $data = $this->http->request('GET', "hypervisor-groups/{$this->groupId}");

        return HypervisorGroup::fromArray($data['data'] ?? $data);
    }

    public function resources(int $page = 1): PaginatedResponse
    {
        $data = $this->http->request('GET', "hypervisor-groups/{$this->groupId}/resources", [
            'query' => ['page' => $page],
        ]);

        return PaginatedResponse::fromArray(
            $data,
            fn(array $item) => HypervisorGroupResource::fromArray($item),
        );
    }
}
