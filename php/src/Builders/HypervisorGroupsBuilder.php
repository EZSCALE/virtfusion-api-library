<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\HypervisorGroup;
use EZScale\VirtFusion\DataObjects\PaginatedResponse;
use EZScale\VirtFusion\HttpClient;

class HypervisorGroupsBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    public function list(int $results = 20): PaginatedResponse
    {
        $data = $this->http->request('GET', 'compute/hypervisors/groups', [
            'query' => ['results' => $results],
        ]);

        return PaginatedResponse::fromArray(
            $data,
            fn(array $item) => HypervisorGroup::fromArray($item),
        );
    }

    public function group(int $id): HypervisorGroupBuilder
    {
        return new HypervisorGroupBuilder($this->http, $id);
    }
}
