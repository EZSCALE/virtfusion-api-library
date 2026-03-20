<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\ActionResult;
use EZScale\VirtFusion\DataObjects\FirewallConfig;
use EZScale\VirtFusion\HttpClient;

class ServerFirewallBuilder
{
    private readonly string $interface;

    public function __construct(
        private readonly HttpClient $http,
        private readonly int $serverId,
        string $interface,
    ) {
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $interface)) {
            throw new \InvalidArgumentException(
                "Invalid interface name: '{$interface}'. Only alphanumeric, hyphens, and underscores are allowed.",
            );
        }
        $this->interface = $interface;
    }

    public function get(): FirewallConfig
    {
        $data = $this->http->request(
            'GET',
            "servers/{$this->serverId}/firewall/{$this->interface}",
        );

        return FirewallConfig::fromArray($data['data'] ?? $data);
    }

    public function enable(): ActionResult
    {
        $data = $this->http->request(
            'POST',
            "servers/{$this->serverId}/firewall/{$this->interface}/enable",
        );

        return ActionResult::fromArray($data);
    }

    public function disable(): ActionResult
    {
        $data = $this->http->request(
            'POST',
            "servers/{$this->serverId}/firewall/{$this->interface}/disable",
        );

        return ActionResult::fromArray($data);
    }

    /**
     * @param int[] $ruleIds
     */
    public function applyRules(array $ruleIds): ActionResult
    {
        $data = $this->http->request(
            'POST',
            "servers/{$this->serverId}/firewall/{$this->interface}/rules",
            ['json' => ['rules' => $ruleIds]],
        );

        return ActionResult::fromArray($data);
    }
}
