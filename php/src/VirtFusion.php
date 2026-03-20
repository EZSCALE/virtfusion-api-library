<?php

declare(strict_types=1);

namespace EZScale\VirtFusion;

use EZScale\VirtFusion\Builders\BackupsBuilder;
use EZScale\VirtFusion\Builders\DnsBuilder;
use EZScale\VirtFusion\Builders\HypervisorGroupsBuilder;
use EZScale\VirtFusion\Builders\HypervisorsBuilder;
use EZScale\VirtFusion\Builders\IpBlocksBuilder;
use EZScale\VirtFusion\Builders\MediaBuilder;
use EZScale\VirtFusion\Builders\PackagesBuilder;
use EZScale\VirtFusion\Builders\QueueBuilder;
use EZScale\VirtFusion\Builders\SelfServiceBuilder;
use EZScale\VirtFusion\Builders\ServerBuilder;
use EZScale\VirtFusion\Builders\SshKeysBuilder;
use EZScale\VirtFusion\Builders\UsersBuilder;
use EZScale\VirtFusion\DataObjects\ConnectionTestResult;
use EZScale\VirtFusion\DataObjects\PaginatedResponse;
use EZScale\VirtFusion\DataObjects\Server;
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

    // --- Servers ---

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

    /**
     * @return Server[]
     */
    public function listServers(): array
    {
        $data = $this->http->request('GET', 'servers');

        return array_map(
            fn(array $item) => Server::fromArray($item),
            $data['data'] ?? [],
        );
    }

    /**
     * @return Server[]
     */
    public function listServersByUser(int $userId): array
    {
        $data = $this->http->request('GET', "servers/user/{$userId}");

        return array_map(
            fn(array $item) => Server::fromArray($item),
            $data['data'] ?? [],
        );
    }

    // --- Hypervisors ---

    public function hypervisors(): HypervisorsBuilder
    {
        return new HypervisorsBuilder($this->http);
    }

    public function hypervisorGroups(): HypervisorGroupsBuilder
    {
        return new HypervisorGroupsBuilder($this->http);
    }

    // --- Packages ---

    public function packages(): PackagesBuilder
    {
        return new PackagesBuilder($this->http);
    }

    // --- Users ---

    public function users(): UsersBuilder
    {
        return new UsersBuilder($this->http);
    }

    // --- SSH Keys ---

    public function sshKeys(): SshKeysBuilder
    {
        return new SshKeysBuilder($this->http);
    }

    // --- IP Blocks ---

    public function ipBlocks(): IpBlocksBuilder
    {
        return new IpBlocksBuilder($this->http);
    }

    // --- Backups ---

    public function backups(): BackupsBuilder
    {
        return new BackupsBuilder($this->http);
    }

    // --- DNS ---

    public function dns(): DnsBuilder
    {
        return new DnsBuilder($this->http);
    }

    // --- Media ---

    public function media(): MediaBuilder
    {
        return new MediaBuilder($this->http);
    }

    // --- Queue ---

    public function queue(): QueueBuilder
    {
        return new QueueBuilder($this->http);
    }

    // --- Self Service ---

    public function selfService(): SelfServiceBuilder
    {
        return new SelfServiceBuilder($this->http);
    }
}
