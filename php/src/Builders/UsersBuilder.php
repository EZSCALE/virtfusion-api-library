<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\User;
use EZScale\VirtFusion\HttpClient;

class UsersBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    /**
     * @param array<string, mixed> $params
     */
    public function create(array $params): User
    {
        $data = $this->http->request('POST', 'users', [
            'json' => $params,
        ]);

        return User::fromArray($data['data'] ?? $data);
    }

    public function getByExtRelation(string $extRelationId, bool $relStr = false): User
    {
        $data = $this->http->request('GET', "users/{$extRelationId}/byExtRelation", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
        ]);

        return User::fromArray($data['data'] ?? $data);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function updateByExtRelation(string $extRelationId, array $params, bool $relStr = false): void
    {
        $this->http->request('PUT', "users/{$extRelationId}/byExtRelation", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
            'json' => $params,
        ]);
    }

    public function deleteByExtRelation(string $extRelationId, bool $relStr = false): void
    {
        $this->http->request('DELETE', "users/{$extRelationId}/byExtRelation", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
        ]);
    }

    /**
     * @return array<string, mixed> Contains email and password
     */
    public function resetPasswordByExtRelation(string $extRelationId, bool $relStr = false): array
    {
        $data = $this->http->request('POST', "users/{$extRelationId}/byExtRelation/resetPassword", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
        ]);

        return $data['data'] ?? $data;
    }

    /**
     * @return array<string, mixed> Contains authentication tokens and endpoint
     */
    public function authenticationTokens(string $extRelationId, bool $relStr = false): array
    {
        $data = $this->http->request('POST', "users/{$extRelationId}/authenticationTokens", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
        ]);

        return $data['data'] ?? $data;
    }

    /**
     * @return array<string, mixed> Contains authentication tokens and endpoint
     */
    public function serverAuthenticationTokens(string $extRelationId, int $serverId, bool $relStr = false): array
    {
        $data = $this->http->request('POST', "users/{$extRelationId}/serverAuthenticationTokens/{$serverId}", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
        ]);

        return $data['data'] ?? $data;
    }
}
