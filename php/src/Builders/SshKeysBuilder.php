<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\SshKey;
use EZScale\VirtFusion\HttpClient;

class SshKeysBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    public function create(int $userId, string $name, string $publicKey): SshKey
    {
        $data = $this->http->request('POST', 'ssh_keys', [
            'json' => [
                'userId' => $userId,
                'name' => $name,
                'publicKey' => $publicKey,
            ],
        ]);

        return SshKey::fromArray($data['data'] ?? $data);
    }

    public function get(int $keyId): SshKey
    {
        $data = $this->http->request('GET', "ssh_keys/{$keyId}");

        return SshKey::fromArray($data['data'] ?? $data);
    }

    /**
     * @return SshKey[]
     */
    public function listByUser(int $userId): array
    {
        $data = $this->http->request('GET', "ssh_keys/user/{$userId}");

        return array_map(
            fn(array $item) => SshKey::fromArray($item),
            $data['data'] ?? [],
        );
    }

    public function delete(int $keyId): void
    {
        $this->http->request('DELETE', "ssh_keys/{$keyId}");
    }
}
