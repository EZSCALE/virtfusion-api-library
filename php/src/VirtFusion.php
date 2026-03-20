<?php

declare(strict_types=1);

namespace EZScale\VirtFusion;

use EZScale\VirtFusion\Builders\HypervisorGroupsBuilder;
use EZScale\VirtFusion\Builders\ServerBuilder;
use EZScale\VirtFusion\DataObjects\ConnectionTestResult;
use EZScale\VirtFusion\DataObjects\ServerCreated;

class VirtFusion
{
    private readonly HttpClient $http;

    public function __construct(
        string $baseUrl,
        string $apiToken,
        ?HttpClient $http = null,
    ) {
        $this->http = $http ?? new HttpClient($baseUrl, $apiToken);
    }

    public function testConnection(): ConnectionTestResult
    {
        $data = $this->http->request('GET', 'connect');

        return ConnectionTestResult::fromArray($data);
    }

    public function server(int $id): ServerBuilder
    {
        return new ServerBuilder($this->http, $id);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function createServer(array $params): ServerCreated
    {
        $data = $this->http->request('POST', 'servers', [
            'json' => $params,
        ]);

        return ServerCreated::fromArray($data['data'] ?? $data);
    }

    public function hypervisorGroups(): HypervisorGroupsBuilder
    {
        return new HypervisorGroupsBuilder($this->http);
    }
}
