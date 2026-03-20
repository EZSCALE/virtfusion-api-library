<?php

declare(strict_types=1);

namespace EZScale\VirtFusion\Builders;

use EZScale\VirtFusion\DataObjects\ActionResult;
use EZScale\VirtFusion\HttpClient;

class SelfServiceBuilder
{
    public function __construct(
        private readonly HttpClient $http,
    ) {
    }

    // --- Credit ---

    /**
     * @return array<string, mixed> Contains credit ID
     */
    public function addCredit(string $extRelationId, float $tokens, ?int $reference1 = null, ?string $reference2 = null, bool $relStr = false): array
    {
        $body = ['tokens' => $tokens];
        if ($reference1 !== null) {
            $body['reference_1'] = $reference1;
        }
        if ($reference2 !== null) {
            $body['reference_2'] = $reference2;
        }

        $data = $this->http->request('POST', "selfService/credit/byUserExtRelationId/{$extRelationId}", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
            'json' => $body,
        ]);

        return $data['data'] ?? $data;
    }

    public function deleteCredit(int $creditId): void
    {
        $this->http->request('DELETE', "selfService/credit/{$creditId}");
    }

    // --- Currencies ---

    /**
     * @return array<mixed>
     */
    public function currencies(): array
    {
        $data = $this->http->request('GET', 'selfService/currencies');

        return $data['data'] ?? [];
    }

    // --- Access ---

    public function syncAccess(string $extRelationId, bool $syncToProfiles = false, bool $relStr = false): void
    {
        $this->http->request('PUT', "selfService/access/byUserExtRelationId/{$extRelationId}", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
            'json' => ['syncToProfiles' => $syncToProfiles],
        ]);
    }

    // --- Hourly Group Profiles ---

    public function addHourlyGroupProfile(string $extRelationId, int $profileId, bool $relStr = false): void
    {
        $this->http->request('POST', "selfService/hourlyGroupProfile/byUserExtRelationId/{$extRelationId}", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
            'json' => ['profileId' => $profileId],
        ]);
    }

    public function removeHourlyGroupProfile(int $profileId, string $extRelationId, bool $relStr = false): void
    {
        $this->http->request('DELETE', "selfService/hourlyGroupProfile/{$profileId}/byUserExtRelationId/{$extRelationId}", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
        ]);
    }

    // --- Resource Group Profiles ---

    public function addResourceGroupProfile(string $extRelationId, int $profileId, bool $relStr = false): void
    {
        $this->http->request('POST', "selfService/resourceGroupProfile/byUserExtRelationId/{$extRelationId}", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
            'json' => ['profileId' => $profileId],
        ]);
    }

    public function removeResourceGroupProfile(int $profileId, string $extRelationId, bool $relStr = false): void
    {
        $this->http->request('DELETE', "selfService/resourceGroupProfile/{$profileId}/byUserExtRelationId/{$extRelationId}", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
        ]);
    }

    // --- Resource Packs ---

    /**
     * @return array<string, mixed> Contains pack ID
     */
    public function createResourcePack(string $extRelationId, int $packId, bool $enabled = true, bool $relStr = false): array
    {
        $data = $this->http->request('POST', "selfService/resourcePack/byUserExtRelationId/{$extRelationId}", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
            'json' => ['packId' => $packId, 'enabled' => $enabled],
        ]);

        return $data['data'] ?? $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function getResourcePack(int $packId, bool $withServers = false): array
    {
        $data = $this->http->request('GET', "selfService/resourcePack/{$packId}", [
            'query' => ['withServers' => $withServers ? 'true' : 'false'],
        ]);

        return $data['data'] ?? $data;
    }

    public function updateResourcePack(int $packId, bool $enabled): void
    {
        $this->http->request('PUT', "selfService/resourcePack/{$packId}", [
            'json' => ['enabled' => $enabled],
        ]);
    }

    public function deleteResourcePack(int $packId, bool $disable = false): void
    {
        $this->http->request('DELETE', "selfService/resourcePack/{$packId}", [
            'query' => ['disable' => $disable ? 'true' : 'false'],
        ]);
    }

    // --- Resource Pack Servers ---

    public function suspendResourcePackServers(int $packId): void
    {
        $this->http->request('POST', "selfService/resourcePackServers/{$packId}/suspend");
    }

    public function unsuspendResourcePackServers(int $packId): void
    {
        $this->http->request('POST', "selfService/resourcePackServers/{$packId}/unsuspend");
    }

    public function deleteResourcePackServers(int $packId, int $delay = 30): void
    {
        $this->http->request('DELETE', "selfService/resourcePackServers/{$packId}", [
            'query' => ['delay' => $delay],
        ]);
    }

    // --- Hourly Resource Pack ---

    public function setHourlyResourcePack(string $extRelationId, int $packId, bool $relStr = false): void
    {
        $this->http->request('PUT', "selfService/hourlyResourcePack/byUserExtRelationId/{$extRelationId}", [
            'query' => ['relStr' => $relStr ? 'true' : 'false'],
            'json' => ['packId' => $packId],
        ]);
    }

    // --- Stats & Reports ---

    /**
     * @param array<string, mixed> $params Query parameters (period[], range, relStr)
     * @return array<string, mixed>
     */
    public function hourlyStats(string $extRelationId, array $params = []): array
    {
        $data = $this->http->request('GET', "selfService/hourlyStats/byUserExtRelationId/{$extRelationId}", [
            'query' => $params,
        ]);

        return $data['data'] ?? $data;
    }

    /**
     * @param array<string, mixed> $params Query parameters (period, currency, relStr)
     * @return array<string, mixed>
     */
    public function report(string $extRelationId, array $params = []): array
    {
        $data = $this->http->request('GET', "selfService/report/byUserExtRelationId/{$extRelationId}", [
            'query' => $params,
        ]);

        return $data['data'] ?? $data;
    }

    /**
     * @param array<string, mixed> $params Query parameters (period[], range, relStr)
     * @return array<string, mixed>
     */
    public function usage(string $extRelationId, array $params = []): array
    {
        $data = $this->http->request('GET', "selfService/usage/byUserExtRelationId/{$extRelationId}", [
            'query' => $params,
        ]);

        return $data['data'] ?? $data;
    }
}
