<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\ActionResult;
use EZScale\VirtFusion\DataObjects\TrafficBlock;
use EZScale\VirtFusion\HttpClient;

class ServerTrafficBlocksBuilder
{
    public function __construct(
        private readonly HttpClient $http,
        private readonly int $serverId,
    ) {
    }

    /**
     * @return TrafficBlock[]
     */
    public function list(): array
    {
        $data = $this->http->request(
            'GET',
            "servers/{$this->serverId}/traffic-blocks",
        );

        return array_map(
            fn(array $block) => TrafficBlock::fromArray($block),
            $data['data'] ?? [],
        );
    }

    /**
     * @param array<string, mixed> $params
     */
    public function add(array $params): ActionResult
    {
        $data = $this->http->request(
            'POST',
            "servers/{$this->serverId}/traffic-blocks",
            ['json' => $params],
        );

        return ActionResult::fromArray($data);
    }

    public function remove(int $blockId): ActionResult
    {
        $data = $this->http->request(
            'DELETE',
            "servers/{$this->serverId}/traffic-blocks/{$blockId}",
        );

        return ActionResult::fromArray($data);
    }
}
