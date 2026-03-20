<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\HttpClient;

class MediaBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function getIso(int $isoId): array
    {
        $data = $this->http->request('GET', "media/iso/{$isoId}");

        return $data['data'] ?? $data;
    }

    /**
     * @return array<mixed>
     */
    public function templatesFromPackageSpec(int $serverPackageId): array
    {
        $data = $this->http->request('GET', "media/templates/fromServerPackageSpec/{$serverPackageId}");

        return $data['data'] ?? [];
    }
}
