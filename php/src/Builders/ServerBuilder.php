<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\ActionResult;
use EZScale\VirtFusion\DataObjects\Server;
use EZScale\VirtFusion\HttpClient;

class ServerBuilder
{
    public function __construct(
        private readonly HttpClient $http,
        private readonly int $serverId,
    ) {
    }

    public function get(): Server
    {
        $data = $this->http->request('GET', "servers/{$this->serverId}");

        return Server::fromArray($data['data'] ?? $data);
    }

    public function boot(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/boot");

        return ActionResult::fromArray($data);
    }

    public function shutdown(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/shutdown");

        return ActionResult::fromArray($data);
    }

    public function restart(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/restart");

        return ActionResult::fromArray($data);
    }

    public function powerOff(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/power-off");

        return ActionResult::fromArray($data);
    }

    public function delete(int $delay = 0): ActionResult
    {
        $data = $this->http->request('DELETE', "servers/{$this->serverId}", [
            'json' => ['delay' => $delay],
        ]);

        return ActionResult::fromArray($data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function build(array $params): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/build", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    public function changePackage(int $packageId): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/change-package", [
            'json' => ['packageId' => $packageId],
        ]);

        return ActionResult::fromArray($data);
    }

    public function modifyBackupPlan(int $planId): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/backup-plan", [
            'json' => ['planId' => $planId],
        ]);

        return ActionResult::fromArray($data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function addToWhitelist(array $params): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/whitelist", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function removeFromWhitelist(array $params): ActionResult
    {
        $data = $this->http->request('DELETE', "servers/{$this->serverId}/whitelist", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function addIpv4(array $params): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/ipv4", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function addIpv4Quantity(array $params): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/ipv4/quantity", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function removeIpv4(array $params): ActionResult
    {
        $data = $this->http->request('DELETE', "servers/{$this->serverId}/ipv4", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function modifyTraffic(array $params): ActionResult
    {
        $data = $this->http->request('PUT', "servers/{$this->serverId}/traffic", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    public function firewall(string $interface): ServerFirewallBuilder
    {
        return new ServerFirewallBuilder($this->http, $this->serverId, $interface);
    }

    public function trafficBlocks(): ServerTrafficBlocksBuilder
    {
        return new ServerTrafficBlocksBuilder($this->http, $this->serverId);
    }
}
