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

    // --- Power ---

    public function boot(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/power/boot");

        return ActionResult::fromArray($data);
    }

    public function shutdown(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/power/shutdown");

        return ActionResult::fromArray($data);
    }

    public function restart(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/power/restart");

        return ActionResult::fromArray($data);
    }

    public function powerOff(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/power/poweroff");

        return ActionResult::fromArray($data);
    }

    // --- Lifecycle ---

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

    public function suspend(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/suspend");

        return ActionResult::fromArray($data);
    }

    public function unsuspend(): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/unsuspend");

        return ActionResult::fromArray($data);
    }

    // --- Modification ---

    public function changePackage(int $packageId): ActionResult
    {
        $data = $this->http->request('PUT', "servers/{$this->serverId}/package/{$packageId}");

        return ActionResult::fromArray($data);
    }

    public function modifyBackupPlan(int $planId): ActionResult
    {
        $data = $this->http->request('PUT', "servers/{$this->serverId}/backups/plan/{$planId}");

        return ActionResult::fromArray($data);
    }

    public function modifyName(string $name): ActionResult
    {
        $data = $this->http->request('PUT', "servers/{$this->serverId}/modify/name", [
            'json' => ['name' => $name],
        ]);

        return ActionResult::fromArray($data);
    }

    public function modifyCpuCores(int $cores): ActionResult
    {
        $data = $this->http->request('PUT', "servers/{$this->serverId}/modify/cpuCores", [
            'json' => ['cores' => $cores],
        ]);

        return ActionResult::fromArray($data);
    }

    public function modifyCpuThrottle(int $percent, bool $sync = false): ActionResult
    {
        $data = $this->http->request('PUT', "servers/{$this->serverId}/modify/cpuThrottle", [
            'query' => ['sync' => $sync ? 'true' : 'false'],
            'json' => ['percent' => $percent],
        ]);

        return ActionResult::fromArray($data);
    }

    public function modifyMemory(int $memoryMb): ActionResult
    {
        $data = $this->http->request('PUT', "servers/{$this->serverId}/modify/memory", [
            'json' => ['memory' => $memoryMb],
        ]);

        return ActionResult::fromArray($data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function modifyTraffic(array $params): ActionResult
    {
        $data = $this->http->request('PUT', "servers/{$this->serverId}/modify/traffic", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    public function changeOwner(int $newOwnerId): ActionResult
    {
        $data = $this->http->request('PUT', "servers/{$this->serverId}/owner/{$newOwnerId}");

        return ActionResult::fromArray($data);
    }

    // --- Password ---

    /**
     * @return array<string, mixed> Contains queueId and expectedPassword
     */
    public function resetPassword(string $user = 'root', bool $sendMail = true): array
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/resetPassword", [
            'json' => ['user' => $user, 'sendMail' => $sendMail],
        ]);

        return $data['data'] ?? $data;
    }

    // --- Custom XML ---

    /**
     * @param array<string, mixed> $params
     */
    public function customXml(array $params): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/customXML", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    // --- Network ---

    /**
     * @param array<string, mixed> $params
     */
    public function addToWhitelist(array $params): ActionResult
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/networkWhitelist", [
            'json' => $params,
        ]);

        return ActionResult::fromArray($data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function removeFromWhitelist(array $params): ActionResult
    {
        $data = $this->http->request('DELETE', "servers/{$this->serverId}/networkWhitelist", [
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
        $data = $this->http->request('POST', "servers/{$this->serverId}/ipv4Qty", [
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

    // --- Traffic ---

    /**
     * @return array<string, mixed>
     */
    public function traffic(): array
    {
        $data = $this->http->request('GET', "servers/{$this->serverId}/traffic");

        return $data['data'] ?? $data;
    }

    // --- Templates ---

    /**
     * @return array<string, mixed>
     */
    public function templates(): array
    {
        $data = $this->http->request('GET', "servers/{$this->serverId}/templates");

        return $data['data'] ?? [];
    }

    // --- VNC ---

    /**
     * @return array<string, mixed>
     */
    public function vnc(): array
    {
        $data = $this->http->request('GET', "servers/{$this->serverId}/vnc");

        return $data['data'] ?? $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function enableVnc(): array
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/vnc", [
            'json' => ['action' => 'enable'],
        ]);

        return $data['data'] ?? $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function disableVnc(): array
    {
        $data = $this->http->request('POST', "servers/{$this->serverId}/vnc", [
            'json' => ['action' => 'disable'],
        ]);

        return $data['data'] ?? $data;
    }

    // --- Sub-builders ---

    public function firewall(string $interface): ServerFirewallBuilder
    {
        return new ServerFirewallBuilder($this->http, $this->serverId, $interface);
    }

    public function trafficBlocks(): ServerTrafficBlocksBuilder
    {
        return new ServerTrafficBlocksBuilder($this->http, $this->serverId);
    }
}
