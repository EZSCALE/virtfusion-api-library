<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\Package;
use EZScale\VirtFusion\HttpClient;

class PackagesBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    /**
     * @return Package[]
     */
    public function list(): array
    {
        $data = $this->http->request('GET', 'packages');

        return array_map(
            fn(array $item) => Package::fromArray($item),
            $data['data'] ?? [],
        );
    }

    public function get(int $packageId): Package
    {
        $data = $this->http->request('GET', "packages/{$packageId}");

        return Package::fromArray($data['data'] ?? $data);
    }
}
