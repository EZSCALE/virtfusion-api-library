<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\ActionResult;
use EZScale\VirtFusion\DataObjects\IpBlock;
use EZScale\VirtFusion\DataObjects\PaginatedResponse;
use EZScale\VirtFusion\HttpClient;

class IpBlocksBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    public function list(int $results = 20): PaginatedResponse
    {
        $data = $this->http->request('GET', 'connectivity/ipblocks', [
            'query' => ['results' => $results],
        ]);

        return PaginatedResponse::fromArray(
            $data,
            fn(array $item) => IpBlock::fromArray($item),
        );
    }

    public function get(int $blockId): IpBlock
    {
        $data = $this->http->request('GET', "connectivity/ipblocks/{$blockId}");

        return IpBlock::fromArray($data['data'] ?? $data);
    }

    public function addIpv4Range(int $blockId, string $start, string $end): ActionResult
    {
        $data = $this->http->request('POST', "connectivity/ipblocks/{$blockId}/ipv4", [
            'json' => ['type' => 'range', 'start' => $start, 'end' => $end],
        ]);

        return ActionResult::fromArray($data);
    }
}
