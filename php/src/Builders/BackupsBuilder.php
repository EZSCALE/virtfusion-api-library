<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\Backup;
use EZScale\VirtFusion\HttpClient;

class BackupsBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    /**
     * @return Backup[]
     */
    public function listByServer(int $serverId): array
    {
        $data = $this->http->request('GET', "backups/server/{$serverId}");

        return array_map(
            fn(array $item) => Backup::fromArray($item),
            $data['data'] ?? [],
        );
    }
}
