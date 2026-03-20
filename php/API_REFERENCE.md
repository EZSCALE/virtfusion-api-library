# VirtFusion API Reference

> Auto-generated from the VirtFusion Global API OpenAPI 3.0.1 specification (v1.0.0).
>
> Base URL: `https://cp.domain.com/api/v1`
>
> Authentication: Bearer token (pass via `Authorization: Bearer <token>` header)

---

## Table of Contents

- [General](#general)
- [Hypervisors](#hypervisors)
- [Hypervisor Groups](#hypervisor-groups)
- [Servers](#servers)
- [Servers/Network](#serversnetwork)
- [Servers/Network/Firewall](#serversnetworkfirewall)
- [Servers/Network/Traffic](#serversnetworktraffic)
- [Servers/Power](#serverspower)
- [IP Blocks](#ip-blocks)
- [Backups](#backups)
- [DNS](#dns)
- [Media](#media)
- [Packages](#packages)
- [Queue & Tasks](#queue--tasks)
- [SSH Keys](#ssh-keys)
- [Users](#users)
- [Users/External Rel ID & Rel Str](#usersexternal-rel-id--rel-str)
- [Self Service](#self-service)
- [Self Service/External Relational ID](#self-serviceexternal-relational-id)

---

## Common Patterns

### Pagination

List endpoints return paginated results with these standard fields:

| Field | Type | Description |
|-------|------|-------------|
| `current_page` | integer | Current page number |
| `data` | array | Array of result objects |
| `first_page_url` | string | URL to the first page |
| `from` | integer | Starting record index |
| `last_page` | integer | Last page number |
| `last_page_url` | string | URL to the last page |
| `links` | array | Pagination link objects |
| `next_page_url` | string (nullable) | URL to the next page |
| `path` | string | Base URL path |
| `per_page` | integer | Results per page |
| `prev_page_url` | string (nullable) | URL to the previous page |
| `to` | integer | Ending record index |
| `total` | integer | Total number of records |

---

## General

### GET `/connect`

**Test connection**

#### Response `200`

#### Response `401`

---

## Hypervisors

### GET `/compute/hypervisors`

**Retrieve hypervisors**

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `results` | integer | No | Number of results to return. Range between 1 and 200. Defaults to 20. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `current_page` | integer | |
| `data` | array[object] | |
|   `id` | integer | |
|   `commissioned` | integer | |
|   `ip` | string | |
|   `ipAlt` | any (nullable) | |
|   `hostname` | any (nullable) | |
|   `port` | integer | |
|   `sshPort` | integer | |
|   `name` | string | |
|   `maintenance` | boolean | |
|   `enabled` | boolean | |
|   `nfType` | integer | |
|   `group` | object | |
|     `id` | integer | |
|     `name` | string | |
|     `description` | string | |
|     `default` | boolean | |
|     `enabled` | boolean | |
|     `distributionType` | integer | |
|     `created` | string | |
|     `updated` | string | |
|   `encryptedToken` | string | |
|   `maxServers` | integer | |
|   `maxCpu` | integer | |
|   `maxMemory` | integer | |
|   `networks` | array[object] | |
|     `id` | integer | |
|     `type` | string | |
|     `bridge` | string | |
|     `primary` | boolean | |
|     `default` | boolean | |
|     `created` | string | |
|     `updated` | string | |
|   `storage` | array | |
|   `created` | string | |
|   `updated` | string | |
| `first_page_url` | string | |
| `from` | integer | |
| `last_page` | integer | |
| `last_page_url` | string | |
| `links` | array[object] | |
| `next_page_url` | string | |
| `path` | string | |
| `per_page` | integer | |
| `prev_page_url` | any (nullable) | |
| `to` | integer | |
| `total` | integer | |

#### Response `401`

---

### GET `/compute/hypervisors/{hypervisorId}`

**Retrive a Hypervisor**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `hypervisorId` | integer | Yes | A valid hypervisor ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `commissioned` | integer | |
|   `ip` | string | |
|   `ipAlt` | any (nullable) | |
|   `hostname` | any (nullable) | |
|   `port` | integer | |
|   `sshPort` | integer | |
|   `name` | string | |
|   `maintenance` | boolean | |
|   `enabled` | boolean | |
|   `nfType` | integer | |
|   `group` | object | |
|     `id` | integer | |
|     `name` | string | |
|     `description` | string | |
|     `default` | boolean | |
|     `enabled` | boolean | |
|     `distributionType` | integer | |
|     `created` | string | |
|     `updated` | string | |
|   `encryptedToken` | string | |
|   `maxServers` | integer | |
|   `maxCpu` | integer | |
|   `maxMemory` | integer | |
|   `created` | string | |
|   `updated` | string | |
|   `networks` | array[object] | |
|     `id` | integer | |
|     `type` | string | |
|     `bridge` | string | |
|     `primary` | boolean | |
|     `default` | boolean | |
|     `created` | string | |
|     `updated` | string | |

#### Response `401`

---

## Hypervisor Groups

### GET `/compute/hypervisors/groups`

**Retrieve hypervisor groups**

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `results` | integer | No | Number of results to return. Range between 1 and 200. Defaults to 20. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `current_page` | integer | |
| `data` | array[object] | |
|   `id` | integer | |
|   `name` | string | |
|   `label` | any (nullable) | |
|   `description` | string | |
|   `distributionType` | integer | |
|   `enabled` | boolean | |
|   `default` | boolean | |
|   `created` | string | |
|   `updated` | string | |
| `first_page_url` | string | |
| `from` | integer | |
| `last_page` | integer | |
| `last_page_url` | string | |
| `links` | array[object] | |
| `next_page_url` | any (nullable) | |
| `path` | string | |
| `per_page` | integer | |
| `prev_page_url` | any (nullable) | |
| `to` | integer | |
| `total` | integer | |

#### Response `401`

---

### GET `/compute/hypervisors/groups/{hypervisorGroupId}`

**Retrieve a hypervisor group**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `hypervisorGroupId` | integer | Yes | A valid hypervisor group ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `name` | string | |
|   `label` | any (nullable) | |
|   `description` | string | |
|   `distributionType` | integer | |
|   `enabled` | boolean | |
|   `default` | boolean | |
|   `created` | string | |
|   `updated` | string | |

#### Response `401`

---

### GET `/compute/hypervisors/groups/{hypervisorGroupId}/resources`

**Retrieve a hypervisor groups resources**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `hypervisorGroupId` | integer | Yes | A valid hypervisor group ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `results` | integer | No | Number of results to return. Range between 1 and 200. Defaults to 20. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `current_page` | integer | |
| `data` | array[object] | |
|   `hypervisor` | object | |
|     `id` | integer | |
|     `name` | string | |
|     `enabled` | boolean | |
|     `prohibit` | boolean | |
|     `accept` | boolean | |
|     `commissioned` | boolean | |
|   `resources` | object | |
|     `servers` | object | |
|       `units` | string | |
|       `max` | integer | |
|       `allocated` | integer | |
|       `free` | integer | |
|       `percent` | any (nullable) | |
|     `memory` | object | |
|       `units` | string | |
|       `max` | integer | |
|       `allocated` | integer | |
|       `free` | integer | |
|       `percent` | number | |
|     `cpuCores` | object | |
|       `units` | string | |
|       `max` | integer | |
|       `allocated` | integer | |
|       `free` | integer | |
|       `percent` | integer | |
|     `localStorage` | object | |
|       `enabled` | integer | |
|       `name` | string | |
|       `storageType` | integer | |
|       `units` | string | |
|       `max` | integer | |
|       `allocated` | integer | |
|       `free` | integer | |
|       `percent` | number | |
|     `otherStorage` | array | |
|     `network` | object | |
|       `total` | object | |
|         `ipv4` | object | |
|           `free` | integer | |
| `first_page_url` | string | |
| `from` | integer | |
| `last_page` | integer | |
| `last_page_url` | string | |
| `links` | array[object] | |
| `next_page_url` | any (nullable) | |
| `path` | string | |
| `per_page` | integer | |
| `prev_page_url` | any (nullable) | |
| `to` | integer | |
| `total` | integer | |

#### Response `401`

---

## Servers

### GET `/servers/{serverId}`

**Retrieve a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `remoteState` | boolean | No | Return the remote state of the server. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `ownerId` | integer | |
|   `hypervisorId` | integer | |
|   `arch` | integer | |
|   `name` | string | |
|   `selfService` | integer | |
|   `selfServiceSettings` | array | |
|   `hostname` | any (nullable) | |
|   `commissionStatus` | integer | |
|   `uuid` | string | |
|   `state` | string | |
|   `migratable` | boolean | |
|   `timezone` | string | |
|   `migrateLevel` | integer | |
|   `deleteLevel` | integer | |
|   `configLevel` | integer | |
|   `backupLevel` | integer | |
|   `elevated` | boolean | |
|   `elevateId` | any (nullable) | |
|   `elevate` | boolean | |
|   `destroyable` | boolean | |
|   `rebuild` | boolean | |
|   `suspended` | boolean | |
|   `protected` | boolean | |
|   `buildFailed` | boolean | |
|   `primaryNetworkDhcp4` | boolean | |
|   `primaryNetworkDhcp6` | boolean | |
|   `built` | string | |
|   `created` | string | |
|   `updated` | string | |
|   `traffic` | object | |
|     `public` | object | |
|       `countMethod` | integer | |
|       `currentPeriod` | object | |
|         `start` | string | |
|         `end` | string | |
|         `limit` | integer | |
|   `settings` | object | |
|     `osTemplateInstall` | boolean | |
|     `osTemplateInstallId` | integer | |
|     `encryptedPassword` | string | |
|     `backupPlan` | any (nullable) | |
|     `uefi` | boolean | |
|     `uefiType` | integer | |
|     `cloudInit` | boolean | |
|     `cloudInitType` | integer | |
|     `config` | object | |
|       `cloud.init` | object | |
|         `on.network` | object | |
|           `netplan_routes_v4` | boolean | |
|           `netplan_routes_v6` | boolean | |
|         `on.network.libvirtrouted` | object | |
|           `netplan_routes_v4` | boolean | |
|           `netplan_routes_v6` | boolean | |
|         `on.all` | object | |
|           `user.data` | object | |
|             `runcmd` | array | |
|         `on.password` | object | |
|           `user.data` | object | |
|             `runcmd` | array | |
|         `on.sshkey` | object | |
|           `user.data` | array | |
|     `userConfig` | array | |
|     `bootOrder` | array | |
|     `tpmType` | integer | |
|     `networkBoot` | boolean | |
|     `bootMenu` | integer | |
|     `customISO` | integer | |
|     `securityDriver` | integer | |
|     `memBalloon` | object | |
|       `model` | integer | |
|       `autoDeflate` | integer | |
|       `freePageReporting` | integer | |
|     `hyperv` | object | |
|       `enabled` | boolean | |
|       `passthrough` | boolean | |
|       `relaxed` | integer | |
|       `vapic` | integer | |
|       `spinlocks` | integer | |
|       `vpindex` | integer | |
|       `runtime` | integer | |
|       `synic` | integer | |
|       `stimer` | integer | |
|       `reset` | integer | |
|       `vendorId` | integer | |
|       `frequencies` | integer | |
|       `reenlightenment` | integer | |
|       `tlbflush` | integer | |
|       `ipi` | integer | |
|       `evmcs` | integer | |
|       `vendorIdValue` | string | |
|       `spinlocksValue` | integer | |
|       `clockEnabled` | integer | |
|     `extended` | object | |
|       `cpuFlags` | object | |
|         `topoext` | string | |
|         `svm` | string | |
|         `vmx` | string | |
|     `machineType` | string | |
|     `pciPorts` | integer | |
|     `resources` | object | |
|       `memory` | integer | |
|       `storage` | integer | |
|       `traffic` | integer | |
|       `cpuCores` | integer | |
|   `cpu` | object | |
|     `cores` | integer | |
|     `type` | string | |
|     `typeExact` | string | |
|     `shares` | integer | |
|     `throttle` | integer | |
|     `topology` | object | |
|       `enabled` | boolean | |
|       `sockets` | integer | |
|       `cores` | integer | |
|       `threads` | integer | |
|       `dies` | integer | |
|   `customXML` | object | |
|     `domain` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `os` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `devices` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `features` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `clock` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `cpuTune` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|   `qemuCommandline` | array | |
|   `qemuAgent` | object | |
|     `os` | object | |
|       `screen` | string | |
|   `media` | object | |
|     `isoMounted` | boolean | |
|     `isoType` | string | |
|     `isoName` | string | |
|     `isoFilename` | string | |
|     `isoUrl` | string | |
|     `isoDownload` | boolean | |
|   `backupPlan` | object | |
|     `id` | any (nullable) | |
|     `name` | any (nullable) | |
|   `vnc` | object | |
|     `ip` | string | |
|     `port` | integer | |
|     `enabled` | boolean | |
|   `network` | object | |
|     `interfaces` | array[object] | |
|       `id` | integer | |
|       `order` | integer | |
|       `enabled` | boolean | |
|       `tag` | integer | |
|       `name` | string | |
|       `type` | string | |
|       `driver` | integer | |
|       `processQueues` | any (nullable) | |
|       `mac` | string | |
|       `ipv4ToMac` | any (nullable) | |
|       `ipv6ToMac` | any (nullable) | |
|       `inTrafficCount` | boolean | |
|       `outTrafficCount` | boolean | |
|       `inAverage` | integer | |
|       `inPeak` | integer | |
|       `inBurst` | integer | |
|       `outAverage` | integer | |
|       `outPeak` | integer | |
|       `outBurst` | integer | |
|       `ipFilter` | boolean | |
|       `vlans` | array | |
|       `ipFilterType` | any (nullable) | |
|       `portIsolated` | boolean | |
|       `ipv4_resolver_1` | integer | |
|       `ipv4_resolver_2` | integer | |
|       `ipv6_resolver_1` | integer | |
|       `ipv6_resolver_2` | integer | |
|       `networkProfile` | integer | |
|       `dhcpV4` | integer | |
|       `dhcpV6` | integer | |
|       `firewallEnabled` | boolean | |
|       `hypervisorNetwork` | integer | |
|       `isNat` | boolean | |
|       `nat` | boolean | |
|       `firewall` | array | |
|       `hypervisorConnectivity` | object | |
|         `id` | integer | |
|         `type` | string | |
|         `bridge` | string | |
|         `mtu` | any (nullable) | |
|         `primary` | boolean | |
|         `default` | boolean | |
|       `ipWhitelist` | array | |
|       `actions` | array | |
|       `ipv4` | array[object] | |
|         `id` | integer | |
|         `order` | integer | |
|         `enabled` | boolean | |
|         `blockId` | integer | |
|         `address` | string | |
|         `gateway` | string | |
|         `netmask` | string | |
|         `resolver1` | string | |
|         `resolver2` | string | |
|         `rdns` | any (nullable) | |
|         `mac` | any (nullable) | |
|       `ipv6` | array[object] | |
|         `id` | integer | |
|         `block` | object | |
|           `id` | integer | |
|           `name` | string | |
|         `order` | integer | |
|         `enabled` | boolean | |
|         `addresses` | array | |
|         `addressesDetailed` | array | |
|         `subnet` | string | |
|         `cidr` | integer | |
|         `exhausted` | boolean | |
|         `gateway` | string | |
|         `resolver1` | string | |
|         `resolver2` | string | |
|         `routeNet` | boolean | |
|     `secondaryInterfaces` | array[object] | |
|       `id` | integer | |
|       `enabled` | boolean | |
|       `order` | integer | |
|       `tag` | integer | |
|       `name` | string | |
|       `type` | string | |
|       `driver` | integer | |
|       `processQueues` | any (nullable) | |
|       `mac` | string | |
|       `ipv4ToMac` | any (nullable) | |
|       `ipv6ToMac` | any (nullable) | |
|       `inTrafficCount` | boolean | |
|       `outTrafficCount` | boolean | |
|       `inAverage` | integer | |
|       `inPeak` | integer | |
|       `inBurst` | integer | |
|       `outAverage` | integer | |
|       `outPeak` | integer | |
|       `outBurst` | integer | |
|       `ipFilter` | boolean | |
|       `vlans` | array | |
|       `ipFilterType` | string | |
|       `portIsolated` | boolean | |
|       `ipv4_resolver_1` | integer | |
|       `ipv4_resolver_2` | integer | |
|       `ipv6_resolver_1` | integer | |
|       `ipv6_resolver_2` | integer | |
|       `networkProfile` | integer | |
|       `dhcpV4` | integer | |
|       `dhcpV6` | integer | |
|       `firewallEnabled` | boolean | |
|       `hypervisorNetwork` | integer | |
|       `isNat` | boolean | |
|       `nat` | boolean | |
|       `firewall` | array | |
|       `hypervisorConnectivity` | object | |
|         `id` | integer | |
|         `type` | string | |
|         `bridge` | string | |
|         `mtu` | any (nullable) | |
|         `primary` | boolean | |
|         `default` | boolean | |
|       `ipWhitelist` | array | |
|       `actions` | array | |
|       `ipv4` | array[object] | |
|         `id` | integer | |
|         `order` | integer | |
|         `enabled` | boolean | |
|         `address` | string | |
|         `gateway` | string | |
|         `netmask` | string | |
|         `resolver1` | string | |
|         `resolver2` | string | |
|         `rdns` | any (nullable) | |
|         `mac` | any (nullable) | |
|       `ipv6` | array[object] | |
|         `id` | integer | |
|         `block` | object | |
|           `id` | integer | |
|           `name` | string | |
|         `order` | integer | |
|         `enabled` | boolean | |
|         `addresses` | array | |
|         `addressesDetailed` | array | |
|         `subnet` | string | |
|         `cidr` | integer | |
|         `exhausted` | boolean | |
|         `gateway` | string | |
|         `resolver1` | string | |
|         `resolver2` | string | |
|         `routeNet` | boolean | |
|   `storage` | array[object] | |
|     `_id` | integer | |
|     `id` | integer | |
|     `cache` | any (nullable) | |
|     `bus` | any (nullable) | |
|     `capacity` | integer | |
|     `drive` | string | |
|     `datastoreDiskId` | any (nullable) | |
|     `filesystem` | any (nullable) | |
|     `iops` | object | |
|       `read` | any (nullable) | |
|       `write` | any (nullable) | |
|     `bytes` | object | |
|       `read` | any (nullable) | |
|       `write` | any (nullable) | |
|     `type` | string | |
|     `profile` | integer | |
|     `status` | integer | |
|     `enabled` | boolean | |
|     `primary` | boolean | |
|     `created` | string | |
|     `updated` | string | |
|     `datastore` | array | |
|     `name` | string | |
|     `filename` | string | |
|     `hypervisorStorageId` | any (nullable) | |
|     `local` | boolean | |
|     `locationType` | string | |
|     `path` | string | |
|   `hypervisorAssets` | array | |
|   `hypervisor` | object | |
|     `id` | integer | |
|     `ip` | string | |
|     `hostname` | any (nullable) | |
|     `port` | integer | |
|     `maintenance` | boolean | |
|     `groupId` | integer | |
|     `group` | object | |
|       `name` | string | |
|       `icon` | any (nullable) | |
|     `timezone` | string | |
|     `forceIPv6` | boolean | |
|     `vncListenType` | integer | |
|     `displayName` | any (nullable) | |
|     `cpuSet` | any (nullable) | |
|     `nfType` | integer | |
|     `backupStorageType` | integer | |
|     `defaultDiskType` | string | |
|     `defaultDiskCacheType` | string | |
|     `defaultCPU` | string | |
|     `defaultMachineType` | string | |
|     `created` | string | |
|     `updated` | string | |
|     `name` | string | |
|     `dataDir` | string | |
|     `resources` | object | |
|       `servers` | object | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | any (nullable) | |
|       `memory` | object | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | number | |
|       `cpuCores` | object | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | number | |
|       `localStorage` | object | |
|         `enabled` | integer | |
|         `name` | string | |
|         `storageType` | integer | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | number | |
|       `otherStorage` | array | |
|   `owner` | object | |
|     `id` | integer | |
|     `admin` | boolean | |
|     `extRelationId` | any (nullable) | |
|     `name` | string | |
|     `email` | string | |
|     `timezone` | string | |
|     `suspended` | boolean | |
|     `twoFactorAuth` | boolean | |
|     `created` | string | |
|     `updated` | string | |
|   `sshKeys` | array[object] | |
|     `id` | integer | |
|     `ownerId` | integer | |
|     `type` | string | |
|     `name` | string | |
|     `public` | string | |
|     `enabled` | boolean | |
|     `created` | string | |
|   `sharedUsers` | array | |
|   `tasks` | object | |
|     `active` | boolean | |
|     `lastOn` | string | |
|     `actions` | object | |
|       `pending` | array | |
|   `remoteState` | boolean | |

#### Response `401`

---

### DELETE `/servers/{serverId}`

**Delete a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `delay` | integer | No | How many minutes the system should wait before deleting the server. (0-43800) |

#### Response `204`

#### Response `401`

---

### PUT `/servers/{serverId}/backups/plan/{planId}`

**Add, remove or modify a backup plan**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |
| `planId` | integer | Yes | A valid backup plan ID as shown in VirtFusion. A value of 0 (zero) will remove the plan. |

#### Response `201`

#### Response `401`

---

### POST `/servers/{serverId}/build`

**Build a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `operatingSystemId` | integer | Yes | A valid operating system template ID. |
| `name` | string | No | Server name. |
| `hostname` | string | No | Server Hostname. |
| `sshKeys` | array[integer] | No | An array of SSH keys. |
| `vnc` | boolean | No | Enable/disable. |
| `ipv6` | boolean | No | Enable/disable. |
| `email` | boolean | No | Enable/disable. |
| `swap` | number | No | Values of 256, 512, 768, 1, 1.5, 2, 3, 4, 5,6 8 |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `ownerId` | integer | |
|   `hypervisorId` | integer | |
|   `arch` | integer | |
|   `name` | string | |
|   `selfService` | integer | |
|   `selfServiceSettings` | array | |
|   `hostname` | string | |
|   `commissionStatus` | integer | |
|   `uuid` | string | |
|   `state` | string | |
|   `migratable` | boolean | |
|   `timezone` | string | |
|   `migrateLevel` | integer | |
|   `deleteLevel` | integer | |
|   `configLevel` | integer | |
|   `backupLevel` | integer | |
|   `elevated` | boolean | |
|   `elevateId` | any (nullable) | |
|   `elevate` | boolean | |
|   `destroyable` | boolean | |
|   `rebuild` | boolean | |
|   `suspended` | boolean | |
|   `protected` | boolean | |
|   `buildFailed` | boolean | |
|   `primaryNetworkDhcp4` | boolean | |
|   `primaryNetworkDhcp6` | boolean | |
|   `built` | string | |
|   `created` | string | |
|   `updated` | string | |
|   `traffic` | object | |
|     `public` | object | |
|       `countMethod` | integer | |
|       `currentPeriod` | object | |
|         `start` | string | |
|         `end` | string | |
|         `limit` | integer | |
|   `settings` | object | |
|     `osTemplateInstall` | boolean | |
|     `osTemplateInstallId` | integer | |
|     `encryptedPassword` | string | |
|     `backupPlan` | any (nullable) | |
|     `uefi` | boolean | |
|     `uefiType` | integer | |
|     `cloudInit` | boolean | |
|     `cloudInitType` | integer | |
|     `config` | object | |
|       `cloud.init` | object | |
|         `on.all` | object | |
|           `user.data` | object | |
|             `runcmd` | array | |
|         `on.password` | object | |
|           `user.data` | array | |
|         `on.sshkey` | object | |
|           `user.data` | array | |
|         `on.allpre` | object | |
|           `user.data` | array | |
|         `on.allpost` | object | |
|           `user.data` | array | |
|         `on.network` | array | |
|         `on.network.libvirtrouted` | array | |
|     `userConfig` | array | |
|     `bootOrder` | array | |
|     `tpmType` | integer | |
|     `networkBoot` | boolean | |
|     `bootMenu` | integer | |
|     `customISO` | integer | |
|     `securityDriver` | integer | |
|     `memBalloon` | object | |
|       `model` | integer | |
|       `autoDeflate` | integer | |
|       `freePageReporting` | integer | |
|     `hyperv` | object | |
|       `enabled` | boolean | |
|       `passthrough` | boolean | |
|       `relaxed` | integer | |
|       `vapic` | integer | |
|       `spinlocks` | integer | |
|       `vpindex` | integer | |
|       `runtime` | integer | |
|       `synic` | integer | |
|       `stimer` | integer | |
|       `reset` | integer | |
|       `vendorId` | integer | |
|       `frequencies` | integer | |
|       `reenlightenment` | integer | |
|       `tlbflush` | integer | |
|       `ipi` | integer | |
|       `evmcs` | integer | |
|       `vendorIdValue` | string | |
|       `spinlocksValue` | integer | |
|       `clockEnabled` | integer | |
|     `extended` | object | |
|       `cpuFlags` | object | |
|         `topoext` | string | |
|         `svm` | string | |
|         `vmx` | string | |
|     `machineType` | string | |
|     `pciPorts` | integer | |
|     `resources` | object | |
|       `memory` | integer | |
|       `storage` | integer | |
|       `traffic` | integer | |
|       `cpuCores` | integer | |
|     `decryptedPassword` | string | |
|   `cpu` | object | |
|     `cores` | integer | |
|     `type` | string | |
|     `typeExact` | string | |
|     `shares` | integer | |
|     `throttle` | integer | |
|     `topology` | object | |
|       `enabled` | boolean | |
|       `sockets` | integer | |
|       `cores` | integer | |
|       `threads` | integer | |
|       `dies` | integer | |
|   `customXML` | object | |
|     `domain` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `os` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `devices` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `features` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `clock` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `cpuTune` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|   `qemuCommandline` | array | |
|   `qemuAgent` | object | |
|     `os` | object | |
|       `screen` | string | |
|   `media` | object | |
|     `isoMounted` | boolean | |
|     `isoType` | string | |
|     `isoName` | string | |
|     `isoFilename` | string | |
|     `isoUrl` | string | |
|     `isoDownload` | boolean | |
|   `backupPlan` | object | |
|     `id` | any (nullable) | |
|     `name` | any (nullable) | |
|   `vnc` | object | |
|     `ip` | string | |
|     `port` | integer | |
|     `enabled` | boolean | |
|   `network` | object | |
|     `interfaces` | array[object] | |
|       `id` | integer | |
|       `order` | integer | |
|       `enabled` | boolean | |
|       `tag` | integer | |
|       `name` | string | |
|       `type` | string | |
|       `driver` | integer | |
|       `processQueues` | any (nullable) | |
|       `mac` | string | |
|       `ipv4ToMac` | any (nullable) | |
|       `ipv6ToMac` | any (nullable) | |
|       `inTrafficCount` | boolean | |
|       `outTrafficCount` | boolean | |
|       `inAverage` | integer | |
|       `inPeak` | integer | |
|       `inBurst` | integer | |
|       `outAverage` | integer | |
|       `outPeak` | integer | |
|       `outBurst` | integer | |
|       `ipFilter` | boolean | |
|       `vlans` | array | |
|       `ipFilterType` | string | |
|       `portIsolated` | boolean | |
|       `ipv4_resolver_1` | integer | |
|       `ipv4_resolver_2` | integer | |
|       `ipv6_resolver_1` | integer | |
|       `ipv6_resolver_2` | integer | |
|       `networkProfile` | integer | |
|       `dhcpV4` | integer | |
|       `dhcpV6` | integer | |
|       `firewallEnabled` | boolean | |
|       `hypervisorNetwork` | integer | |
|       `isNat` | boolean | |
|       `nat` | boolean | |
|       `firewall` | array | |
|       `hypervisorConnectivity` | object | |
|         `id` | integer | |
|         `type` | string | |
|         `bridge` | string | |
|         `mtu` | any (nullable) | |
|         `primary` | boolean | |
|         `default` | boolean | |
|       `ipWhitelist` | array[object] | |
|         `id` | integer | |
|         `type` | integer | |
|         `ip` | string | |
|         `mask` | integer | |
|       `actions` | array | |
|       `ipv4` | array[object] | |
|         `id` | integer | |
|         `order` | integer | |
|         `enabled` | boolean | |
|         `blockId` | integer | |
|         `address` | string | |
|         `gateway` | string | |
|         `netmask` | string | |
|         `resolver1` | string | |
|         `resolver2` | string | |
|         `rdns` | any (nullable) | |
|         `mac` | any (nullable) | |
|       `ipv6` | array | |
|     `secondaryInterfaces` | array | |
|   `storage` | array[object] | |
|     `_id` | integer | |
|     `id` | integer | |
|     `cache` | any (nullable) | |
|     `bus` | any (nullable) | |
|     `capacity` | integer | |
|     `drive` | string | |
|     `datastoreDiskId` | any (nullable) | |
|     `filesystem` | any (nullable) | |
|     `iops` | object | |
|       `read` | any (nullable) | |
|       `write` | any (nullable) | |
|     `bytes` | object | |
|       `read` | any (nullable) | |
|       `write` | any (nullable) | |
|     `type` | string | |
|     `profile` | integer | |
|     `status` | integer | |
|     `enabled` | boolean | |
|     `primary` | boolean | |
|     `created` | string | |
|     `updated` | string | |
|     `datastore` | array | |
|     `name` | string | |
|     `filename` | string | |
|     `hypervisorStorageId` | any (nullable) | |
|     `local` | boolean | |
|     `locationType` | string | |
|     `path` | string | |
|   `hypervisorAssets` | array | |
|   `hypervisor` | object | |
|     `id` | integer | |
|     `ip` | string | |
|     `hostname` | any (nullable) | |
|     `port` | integer | |
|     `maintenance` | boolean | |
|     `groupId` | integer | |
|     `group` | object | |
|       `name` | string | |
|       `icon` | any (nullable) | |
|     `timezone` | string | |
|     `forceIPv6` | boolean | |
|     `vncListenType` | integer | |
|     `displayName` | any (nullable) | |
|     `cpuSet` | any (nullable) | |
|     `nfType` | integer | |
|     `backupStorageType` | integer | |
|     `defaultDiskType` | string | |
|     `defaultDiskCacheType` | string | |
|     `defaultCPU` | string | |
|     `defaultMachineType` | string | |
|     `created` | string | |
|     `updated` | string | |
|     `name` | string | |
|     `dataDir` | string | |
|     `resources` | object | |
|       `servers` | object | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | any (nullable) | |
|       `memory` | object | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | number | |
|       `cpuCores` | object | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | number | |
|       `localStorage` | object | |
|         `enabled` | integer | |
|         `name` | string | |
|         `storageType` | integer | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | number | |
|       `otherStorage` | array | |
|   `owner` | object | |
|     `id` | integer | |
|     `admin` | boolean | |
|     `extRelationId` | integer | |
|     `name` | string | |
|     `email` | string | |
|     `timezone` | string | |
|     `suspended` | boolean | |
|     `twoFactorAuth` | boolean | |
|     `created` | string | |
|     `updated` | string | |
|   `sshKeys` | array | |
|   `sharedUsers` | array | |
|   `tasks` | object | |
|     `active` | boolean | |
|     `lastOn` | string | |
|     `actions` | object | |
|       `pending` | array | |

#### Response `401`

---

### PUT `/servers/{serverId}/package/{packageId}`

**Change a server package**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |
| `packageId` | integer | Yes | A valid package ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `backupPlan` | boolean | No |  |
| `cpu` | boolean | No |  |
| `memory` | boolean | No |  |
| `primaryDiskReadIOPS` | boolean | No |  |
| `primaryDiskReadThroughput` | boolean | No |  |
| `primaryDiskSize` | boolean | No |  |
| `primaryDiskWriteIOPS` | boolean | No |  |
| `primaryDiskWriteThroughput` | boolean | No |  |
| `primaryNetworkInboundSpeed` | boolean | No |  |
| `primaryNetworkOutboundSpeed` | boolean | No |  |
| `primaryNetworkTraffic` | boolean | No |  |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `info` | array | |

#### Response `401`

---

### POST `/servers`

**Create a server**

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `dryRun` | boolean | No | Test to see if a server can be created without actual creation. true|false Defaults to false. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `packageId` | integer | Yes | A valid package ID. |
| `userId` | integer | Yes | A valid user ID. |
| `hypervisorId` | integer | Yes | A valid hypervisor group ID. |
| `ipv4` | integer | No | Number of IPv4 addresses. |
| `storage` | integer | No | Number of GB primary storage. |
| `traffic` | integer | No | Number of GB traffic (0=unlimited). |
| `memory` | integer | No | Number of MB memory. |
| `cpuCores` | integer | No | Number of CPU cores. |
| `networkSpeedInbound` | integer | No | Inbound network speed (kB/s). |
| `networkSpeedOutbound` | integer | No | Outbound network speed (kB/s). |
| `storageProfile` | integer | No | Storage profile ID. |
| `networkProfile` | integer | No | Network profile ID. |
| `firewallRulesets` | array[integer] | No | Array of firewall rulesets. This will override package settings. A value of -1 will force no rulesets to be applied. |
| `hypervisorAssetGroups` | array[integer] | No | Array of hypervisor asset groups. This will override package settings. A value of -1 will force no groups to be applied. |
| `additionalStorage1Enable` | boolean | No | Enable/disable additional storage 1. |
| `additionalStorage2Enable` | boolean | No | Enable/disable additional storage 2. |
| `additionalStorage1Profile` | integer | No | Additional storage 1 profile ID. |
| `additionalStorage2Profile` | integer | No | Additional storage 2 profile ID. |
| `additionalStorage1Capacity` | integer | No | Number of GB additional storage 1 capacity. |
| `additionalStorage2Capacity` | integer | No | Number of GB additional storage 2 capacity. |

#### Response `201`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `ownerId` | integer | |
|   `hypervisorId` | integer | |
|   `arch` | integer | |
|   `name` | string | |
|   `selfService` | integer | |
|   `selfServiceSettings` | array | |
|   `hostname` | any (nullable) | |
|   `commissionStatus` | integer | |
|   `uuid` | string | |
|   `state` | string | |
|   `migratable` | boolean | |
|   `timezone` | string | |
|   `migrateLevel` | integer | |
|   `deleteLevel` | integer | |
|   `configLevel` | integer | |
|   `backupLevel` | integer | |
|   `elevated` | boolean | |
|   `elevateId` | any (nullable) | |
|   `elevate` | boolean | |
|   `destroyable` | boolean | |
|   `rebuild` | boolean | |
|   `suspended` | boolean | |
|   `protected` | boolean | |
|   `buildFailed` | boolean | |
|   `primaryNetworkDhcp4` | boolean | |
|   `primaryNetworkDhcp6` | boolean | |
|   `built` | any (nullable) | |
|   `created` | string | |
|   `updated` | string | |
|   `traffic` | object | |
|     `public` | object | |
|       `countMethod` | integer | |
|       `currentPeriod` | object | |
|         `start` | string | |
|         `end` | string | |
|         `limit` | integer | |
|   `settings` | object | |
|     `osTemplateInstall` | boolean | |
|     `osTemplateInstallId` | integer | |
|     `encryptedPassword` | string | |
|     `backupPlan` | any (nullable) | |
|     `uefi` | boolean | |
|     `uefiType` | integer | |
|     `cloudInit` | boolean | |
|     `cloudInitType` | integer | |
|     `config` | array | |
|     `userConfig` | array | |
|     `bootOrder` | array | |
|     `tpmType` | integer | |
|     `networkBoot` | boolean | |
|     `bootMenu` | integer | |
|     `customISO` | integer | |
|     `securityDriver` | integer | |
|     `memBalloon` | object | |
|       `model` | integer | |
|       `autoDeflate` | integer | |
|       `freePageReporting` | integer | |
|     `hyperv` | object | |
|       `enabled` | boolean | |
|       `passthrough` | boolean | |
|       `relaxed` | integer | |
|       `vapic` | integer | |
|       `spinlocks` | integer | |
|       `vpindex` | integer | |
|       `runtime` | integer | |
|       `synic` | integer | |
|       `stimer` | integer | |
|       `reset` | integer | |
|       `vendorId` | integer | |
|       `frequencies` | integer | |
|       `reenlightenment` | integer | |
|       `tlbflush` | integer | |
|       `ipi` | integer | |
|       `evmcs` | integer | |
|       `vendorIdValue` | string | |
|       `spinlocksValue` | integer | |
|       `clockEnabled` | integer | |
|     `extended` | object | |
|       `cpuFlags` | object | |
|         `topoext` | string | |
|         `svm` | string | |
|         `vmx` | string | |
|     `machineType` | string | |
|     `pciPorts` | integer | |
|     `resources` | object | |
|       `memory` | integer | |
|       `storage` | integer | |
|       `traffic` | integer | |
|       `cpuCores` | integer | |
|   `cpu` | object | |
|     `cores` | integer | |
|     `type` | string | |
|     `typeExact` | string | |
|     `shares` | integer | |
|     `throttle` | integer | |
|     `topology` | object | |
|       `enabled` | boolean | |
|       `sockets` | integer | |
|       `cores` | integer | |
|       `threads` | integer | |
|       `dies` | integer | |
|   `customXML` | object | |
|     `domain` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `os` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `devices` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `features` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `clock` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|     `cpuTune` | object | |
|       `xml` | string | |
|       `enabled` | boolean | |
|   `qemuCommandline` | array | |
|   `qemuAgent` | object | |
|     `os` | object | |
|       `screen` | string | |
|   `media` | object | |
|     `isoMounted` | boolean | |
|     `isoType` | string | |
|     `isoName` | string | |
|     `isoFilename` | string | |
|     `isoUrl` | string | |
|     `isoDownload` | boolean | |
|   `backupPlan` | object | |
|     `id` | any (nullable) | |
|     `name` | any (nullable) | |
|   `vnc` | object | |
|     `ip` | string | |
|     `port` | integer | |
|     `enabled` | boolean | |
|   `network` | object | |
|     `interfaces` | array[object] | |
|       `id` | integer | |
|       `order` | integer | |
|       `enabled` | boolean | |
|       `tag` | integer | |
|       `name` | string | |
|       `type` | string | |
|       `driver` | any (nullable) | |
|       `processQueues` | any (nullable) | |
|       `mac` | string | |
|       `ipv4ToMac` | any (nullable) | |
|       `ipv6ToMac` | any (nullable) | |
|       `inTrafficCount` | boolean | |
|       `outTrafficCount` | boolean | |
|       `inAverage` | integer | |
|       `inPeak` | integer | |
|       `inBurst` | integer | |
|       `outAverage` | integer | |
|       `outPeak` | integer | |
|       `outBurst` | integer | |
|       `ipFilter` | boolean | |
|       `vlans` | array | |
|       `ipFilterType` | string | |
|       `portIsolated` | boolean | |
|       `ipv4_resolver_1` | integer | |
|       `ipv4_resolver_2` | integer | |
|       `ipv6_resolver_1` | integer | |
|       `ipv6_resolver_2` | integer | |
|       `networkProfile` | integer | |
|       `dhcpV4` | integer | |
|       `dhcpV6` | integer | |
|       `firewallEnabled` | boolean | |
|       `hypervisorNetwork` | integer | |
|       `isNat` | boolean | |
|       `nat` | boolean | |
|       `firewall` | array | |
|       `hypervisorConnectivity` | object | |
|         `id` | integer | |
|         `type` | string | |
|         `bridge` | string | |
|         `mtu` | any (nullable) | |
|         `primary` | boolean | |
|         `default` | boolean | |
|       `ipWhitelist` | array | |
|       `actions` | array | |
|       `ipv4` | array[object] | |
|         `id` | integer | |
|         `order` | integer | |
|         `enabled` | boolean | |
|         `blockId` | integer | |
|         `address` | string | |
|         `gateway` | string | |
|         `netmask` | string | |
|         `resolver1` | string | |
|         `resolver2` | string | |
|         `rdns` | any (nullable) | |
|         `mac` | any (nullable) | |
|       `ipv6` | array | |
|     `secondaryInterfaces` | array | |
|   `storage` | array[object] | |
|     `_id` | integer | |
|     `id` | integer | |
|     `cache` | any (nullable) | |
|     `bus` | any (nullable) | |
|     `capacity` | integer | |
|     `drive` | string | |
|     `datastoreDiskId` | any (nullable) | |
|     `filesystem` | any (nullable) | |
|     `iops` | object | |
|       `read` | any (nullable) | |
|       `write` | any (nullable) | |
|     `bytes` | object | |
|       `read` | any (nullable) | |
|       `write` | any (nullable) | |
|     `type` | string | |
|     `profile` | integer | |
|     `status` | integer | |
|     `enabled` | boolean | |
|     `primary` | boolean | |
|     `created` | string | |
|     `updated` | string | |
|     `datastore` | array | |
|     `name` | string | |
|     `filename` | string | |
|     `hypervisorStorageId` | any (nullable) | |
|     `local` | boolean | |
|     `locationType` | string | |
|     `path` | string | |
|   `hypervisorAssets` | array | |
|   `hypervisor` | object | |
|     `id` | integer | |
|     `ip` | string | |
|     `hostname` | any (nullable) | |
|     `port` | integer | |
|     `maintenance` | boolean | |
|     `groupId` | integer | |
|     `group` | object | |
|       `name` | string | |
|       `icon` | any (nullable) | |
|     `timezone` | string | |
|     `forceIPv6` | boolean | |
|     `vncListenType` | integer | |
|     `displayName` | any (nullable) | |
|     `cpuSet` | any (nullable) | |
|     `nfType` | integer | |
|     `backupStorageType` | integer | |
|     `defaultDiskType` | string | |
|     `defaultDiskCacheType` | string | |
|     `defaultCPU` | string | |
|     `defaultMachineType` | string | |
|     `created` | string | |
|     `updated` | string | |
|     `name` | string | |
|     `dataDir` | string | |
|     `resources` | object | |
|       `servers` | object | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | any (nullable) | |
|       `memory` | object | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | number | |
|       `cpuCores` | object | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | number | |
|       `localStorage` | object | |
|         `enabled` | integer | |
|         `name` | string | |
|         `storageType` | integer | |
|         `units` | string | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | integer | |
|       `otherStorage` | array[object] | |
|         `id` | integer | |
|         `name` | string | |
|         `enabled` | integer | |
|         `path` | any (nullable) | |
|         `units` | string | |
|         `storageType` | integer | |
|         `isDatastore` | boolean | |
|         `max` | integer | |
|         `allocated` | integer | |
|         `free` | integer | |
|         `percent` | number | |
|   `owner` | object | |
|     `id` | integer | |
|     `admin` | boolean | |
|     `extRelationId` | any (nullable) | |
|     `name` | string | |
|     `email` | string | |
|     `timezone` | string | |
|     `suspended` | boolean | |
|     `twoFactorAuth` | boolean | |
|     `created` | string | |
|     `updated` | string | |
|   `sshKeys` | array | |
|   `sharedUsers` | array | |
|   `tasks` | object | |
|     `active` | boolean | |
|     `lastOn` | any (nullable) | |
|     `actions` | object | |
|       `pending` | array[object] | |
|         `id` | integer | |
|         `action` | string | |
|         `requires` | array | |
|         `collected` | boolean | |
|         `complete` | boolean | |
|         `failed` | boolean | |
|         `payload` | object | |
|           `disk` | object | |
|             `id` | integer | |
|             `disk_storage_id` | any (nullable) | |
|         `created` | string | |

#### Response `401`

#### Response `422`

| Field | Type | Description |
|-------|------|-------------|
| `errors` | array | |

---

### GET `/servers`

**Retrieve servers**

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `type` | string | No | simple or full. Defaults to simple. |
| `results` | integer | No | Number of results to return. Range between 1 and 200. Defaults to 20. |
| `hypervisorId` | integer | No | Filter by hypervisor ID. Specify multiple with hypervisorId[]=1&hypervisorId[]=2 etc... |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `current_page` | integer | |
| `data` | array[object] | |
|   `id` | integer | |
|   `uuid` | string | |
|   `name` | string | |
|   `commissioned` | integer | |
|   `owner` | integer | |
|   `hypervisorId` | integer | |
|   `suspended` | boolean | |
|   `protected` | boolean | |
|   `updated` | string | |
|   `created` | string | |
| `first_page_url` | string | |
| `from` | integer | |
| `last_page` | integer | |
| `last_page_url` | string | |
| `links` | array[object] | |
| `next_page_url` | string | |
| `path` | string | |
| `per_page` | integer | |
| `prev_page_url` | any (nullable) | |
| `to` | integer | |
| `total` | integer | |

#### Response `401`

---

### PUT `/servers/{serverId}/modify/name`

**Modify name**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `name` | string | Yes | The new name of the server. |

#### Response `201`

#### Response `401`

---

### POST `/servers/{serverId}/resetPassword`

**Reset a server password**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `user` | string | Yes | Either root or Administrator. |
| `sendMail` | boolean | No | Optional (default true) Email the password to the user. (true|false). |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `queueId` | integer | |
|   `expectedPassword` | string | |

#### Response `401`

---

### GET `/servers/user/{userId}`

**Retrieve a users servers**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `userId` | integer | Yes | A valid user ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | array[object] | |
|   `id` | integer | |
|   `ownerId` | integer | |
|   `hypervisorId` | integer | |
|   `name` | string | |
|   `hostname` | string | |
|   `commissionStatus` | integer | |
|   `uuid` | string | |
|   `state` | string | |
|   `rebuild` | boolean | |
|   `suspended` | boolean | |
|   `protected` | boolean | |
|   `buildFailed` | boolean | |
|   `backup_level` | integer | |
|   `backup_plan` | any (nullable) | |
|   `os` | object | |
|     `screen` | string | |
|   `server_info` | object | |
|     `show` | boolean | |
|     `icon` | any (nullable) | |
|     `name` | any (nullable) | |
|     `label` | any (nullable) | |
|   `vnc` | object | |
|     `expose_details` | boolean | |
|     `ip` | string | |
|     `hostname` | any (nullable) | |
|     `port` | integer | |
|     `enabled` | integer | |
|   `resources` | object | |
|     `memory` | integer | |
|     `storage` | integer | |
|     `traffic` | integer | |
|     `cpuCores` | integer | |
|     `cpu_model` | any (nullable) | |
|   `network` | object | |
|     `interfaces` | array[object] | |
|       `order` | integer | |
|       `enabled` | boolean | |
|       `tag` | integer | |
|       `name` | string | |
|       `mac` | string | |
|       `inAverage` | integer | |
|       `inPeak` | integer | |
|       `inBurst` | integer | |
|       `outAverage` | integer | |
|       `outPeak` | integer | |
|       `outBurst` | integer | |
|       `isNat` | boolean | |
|       `ipv4` | array[object] | |
|         `order` | integer | |
|         `enabled` | boolean | |
|         `address` | string | |
|         `gateway` | string | |
|         `netmask` | string | |
|         `resolver1` | string | |
|         `resolver2` | string | |
|       `ipv6` | array | |
|   `config` | object | |
|     `uefi` | boolean | |
|     `bootOrder` | array | |
|   `media` | object | |
|     `isoMounted` | boolean | |
|     `isoName` | string | |

#### Response `401`

---

### GET `/servers/{serverId}/templates`

**Retrieve OS templates available to a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | array[object] | |
|   `name` | string | |
|   `description` | string | |
|   `icon` | string | |
|   `templates` | array[object] | |
|     `id` | integer | |
|     `name` | string | |
|     `version` | string | |
|     `variant` | string | |
|     `arch` | integer | |
|     `description` | string | |
|     `icon` | string | |
|     `eol` | boolean | |
|     `eol_date` | string | |
|     `eol_warning` | boolean | |
|     `deploy_type` | integer | |
|     `vnc` | boolean | |
|     `type` | string | |
|   `id` | integer | |

#### Response `401`

---

### POST `/servers/{serverId}/suspend`

**Suspend a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `204`

#### Response `401`

---

### PUT `/servers/{serverId}/modify/cpuThrottle`

**Throttle a servers CPU**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `sync` | boolean | No | Synchronise and apply the defined percentage. true|false Defaults to false. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `percent` | integer | Yes | The percentage the CPU should be throttled (0-99). |

#### Response `201`

#### Response `401`

---

### GET `/servers/{serverId}/traffic`

**Retrieve a servers traffic statistics**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `monthly` | array[object] | |
|     `month` | integer | |
|     `start` | string | |
|     `end` | string | |
|     `rx` | integer | |
|     `tx` | integer | |
|     `total` | integer | |
|     `limit` | integer | |
|     `blocks` | array[object] | |
|       `id` | integer | |
|       `traffic` | integer | |

#### Response `401`

---

### POST `/servers/{serverId}/unsuspend`

**Unsuspend a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `204`

#### Response `401`

---

### POST `/servers/{serverId}/vnc`

**Enable or disable VNC**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `action` | string (enum: enable, disable) | Yes |  |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `vnc` | object | |
|     `ip` | string | |
|     `hostname` | any (nullable) | |
|     `port` | integer | |
|     `password` | string | |
|     `wss` | object | |
|       `token` | string | |
|       `url` | string | |
|     `enabled` | boolean | |
|   `queueId` | any (nullable) | |

#### Response `401`

---

### GET `/servers/{serverId}/vnc`

**Retrive VNC details**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `vnc` | object | |
|     `ip` | string | |
|     `hostname` | any (nullable) | |
|     `port` | integer | |
|     `password` | string | |
|     `wss` | object | |
|       `token` | string | |
|       `url` | string | |
|     `enabled` | boolean | |

#### Response `401`

---

### PUT `/servers/{serverId}/owner/{newOwnerId}`

**Change owner**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |
| `newOwnerId` | integer | Yes | A vailid user ID as shown in VirtFusion. |

#### Response `201`

#### Response `401`

---

### PUT `/servers/{serverId}/modify/memory`

**Modify memory**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `memory` | integer | Yes | The new memory value in MB. |

#### Response `201`

#### Response `401`

---

### PUT `/servers/{serverId}/modify/cpuCores`

**Modify CPU cores**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `cores` | integer | Yes | The new core value. |

#### Response `201`

#### Response `401`

---

### POST `/servers/{serverId}/customXML`

**Set custom XML**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `domain` | string | No |  |
| `os` | string | No |  |
| `devices` | string | No |  |
| `features` | string | No |  |
| `clock` | string | No |  |
| `cpuTune` | string | No |  |
| `domainEnabled` | boolean | No |  |
| `osEnabled` | boolean | No |  |
| `devicesEnabled` | boolean | No |  |
| `featuresEnabled` | boolean | No |  |
| `clockEnabled` | boolean | No |  |
| `cpuTuneEnabled` | boolean | No |  |

#### Response `200`

#### Response `401`

---

## Servers/Network

### POST `/servers/{serverId}/networkWhitelist`

**Add an address to the whitelist**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `interface` | string | Yes | Primary or secondary. |
| `ip` | string | Yes | IPv4 or IPv6 address. |
| `cidr` | integer | Yes | IPv4 or IPv6 CIDR. |

#### Response `201`

#### Response `401`

---

### DELETE `/servers/{serverId}/networkWhitelist`

**Remove an address from the whitelist**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `interface` | string | Yes | Primary or secondary. |
| `ip` | string | Yes | IPv4 or IPv6 address. |

#### Response `204`

#### Response `401`

---

### POST `/servers/{serverId}/ipv4Qty`

**Add a quantity of IPv4 addresses**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `interface` | string | Yes | Primary or secondary. |
| `quantity` | integer | Yes | Number of IPv4 addresses. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | array | |

#### Response `401`

---

### POST `/servers/{serverId}/ipv4`

**Add an array of IPv4 addresses**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `ip` | array[string] | Yes |  |

#### Response `204`

#### Response `401`

---

### DELETE `/servers/{serverId}/ipv4`

**Remove an array of IPv4 addresses**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `ip` | array[string] | Yes | Valid IPv4 addresses. |

#### Response `204`

#### Response `401`

---

## Servers/Network/Firewall

### POST `/servers/{serverId}/firewall/{interface}/disable`

**Disable firewall**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |
| `interface` | string | Yes | primary or secondary. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `sync` | boolean | No | Synchronise and apply the defined rules. true|false Defaults to false. |

#### Response `200`

#### Response `401`

---

### POST `/servers/{serverId}/firewall/{interface}/enable`

**Enable firewall**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |
| `interface` | string | Yes | primary or secondary. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `sync` | boolean | No | Synchronise and apply the defined rules. true|false Defaults to false. |

#### Response `200`

#### Response `401`

---

### GET `/servers/{serverId}/firewall/{interface}`

**Retrieve firewall**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |
| `interface` | string | Yes | primary or secondary. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `sync` | boolean | No | Synchronise and apply the defined rules. true|false Defaults to false. |

#### Response `200`

#### Response `401`

---

### POST `/servers/{serverId}/firewall/{interface}/rules`

**Apply firewall rulesets**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |
| `interface` | string | Yes | primary or secondary. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `sync` | boolean | No | Synchronise and apply the defined rules. true|false Defaults to false. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `rulesets` | array[integer] | Yes | An array of ruleset IDs. All existing rules will be flushed and the new rules applied. An empty array will flush all rules. |

#### Response `201`

#### Response `401`

---

## Servers/Network/Traffic

### POST `/servers/{serverId}/traffic/blocks`

**Add a traffic block to a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `month` | integer | Yes | The numeric month as returned by the GET request (available). |
| `amount` | integer | Yes | An amount of traffic in GB. |

#### Response `201`

#### Response `401`

---

### GET `/servers/{serverId}/traffic/blocks`

**Retrieve a servers traffic blocks**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `month` | integer | Yes | The numeric month as returned by the GET request (available). |
| `amount` | integer | Yes | An amount of traffic in GB. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `assigned` | array[object] | |
|     `id` | integer | |
|     `current` | boolean | |
|     `month` | integer | |
|     `traffic` | integer | |
|     `start` | string | |
|     `end` | string | |
|     `added` | string | |
|   `available` | object | |
|     `total` | integer | |
|     `current` | object | |
|       `month` | integer | |
|       `start` | string | |
|       `end` | string | |
|     `months` | object | |
|       `1` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `2` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `3` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `4` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `5` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `6` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `7` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `8` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `9` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `10` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `11` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `12` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `13` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `14` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `15` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `16` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `17` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `18` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `19` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `20` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `21` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `22` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `23` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `24` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |
|       `25` | object | |
|         `month` | integer | |
|         `start` | string | |
|         `end` | string | |

#### Response `401`

---

### DELETE `/servers/{serverId}/traffic/blocks/{blockId}`

**Remove a traffic block from a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |
| `blockId` | string | Yes | ID of an assigned traffic block as returned by the GET request (assigned). |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `month` | integer | Yes | The numeric month as returned by the GET request (available). |
| `amount` | integer | Yes | An amount of traffic in GB. |

#### Response `204`

#### Response `401`

---

### PUT `/servers/{serverId}/modify/traffic`

**Modify primary traffic allowance**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `traffic` | string | Yes | Range of 0 - 999999999 |

#### Response `201`

#### Response `401`

---

## Servers/Power

### POST `/servers/{serverId}/power/boot`

**Boot a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `queueId` | integer | |

#### Response `401`

---

### POST `/servers/{serverId}/power/shutdown`

**Shutdown a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `queueId` | integer | |

#### Response `401`

---

### POST `/servers/{serverId}/power/restart`

**Restart a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `queueId` | integer | |

#### Response `401`

---

### POST `/servers/{serverId}/power/poweroff`

**Poweroff a server**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `queueId` | integer | |

#### Response `401`

---

## IP Blocks

### POST `/connectivity/ipblocks/{blockId}/ipv4`

**Add an IPv4 range to an IP block**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `blockId` | integer | Yes | A valid IPv4 block ID as shown in VirtFusion. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `type` | string | Yes | Must be set to range. |
| `start` | string | Yes | Start of IPv4 range. |
| `end` | string | Yes | End of IPv4 range. |

#### Response `204`

#### Response `401`

---

### GET `/connectivity/ipblocks`

**Retrieve IP blocks**

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `results` | integer | No | Number of results to return. Range between 1 and 200. Defaults to 20. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `current_page` | integer | |
| `data` | array[object] | |
|   `id` | integer | |
|   `type` | integer | |
|   `name` | string | |
|   `ipv4` | object | |
|     `gateway` | string | |
|     `netmask` | string | |
|     `resolvers` | object | |
|       `primary` | string | |
|       `secondary` | string | |
|     `total` | integer | |
|     `usedTotal` | integer | |
|     `freeTotal` | integer | |
|   `ipv6` | object | |
|     `gateway` | any (nullable) | |
|     `resolvers` | object | |
|       `primary` | any (nullable) | |
|       `secondary` | any (nullable) | |
|     `subnet` | any (nullable) | |
|     `from` | integer | |
|     `to` | integer | |
|     `restricted` | array | |
|     `total` | integer | |
|     `generatedTotal` | integer | |
|     `usedTotal` | integer | |
|     `freeTotal` | integer | |
|     `freeGenerated` | integer | |
|     `blacklistedTotal` | integer | |
|   `rdnsType` | integer | |
|   `rdnsZoneId` | any (nullable) | |
|   `networkProfile` | integer | |
|   `routeBlock` | any (nullable) | |
|   `dhcp` | integer | |
|   `enabled` | boolean | |
|   `created` | string | |
|   `updated` | string | |
| `first_page_url` | string | |
| `from` | integer | |
| `last_page` | integer | |
| `last_page_url` | string | |
| `links` | array[object] | |
| `next_page_url` | any (nullable) | |
| `path` | string | |
| `per_page` | integer | |
| `prev_page_url` | any (nullable) | |
| `to` | integer | |
| `total` | integer | |

#### Response `401`

---

### GET `/connectivity/ipblocks/{blockId}`

**Retrieve an IP block**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `blockId` | integer | Yes | A valid IP block ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `type` | integer | |
|   `name` | string | |
|   `ipv4` | object | |
|     `gateway` | string | |
|     `netmask` | string | |
|     `resolvers` | object | |
|       `primary` | string | |
|       `secondary` | string | |
|     `total` | integer | |
|     `usedTotal` | integer | |
|     `freeTotal` | integer | |
|   `ipv6` | object | |
|     `gateway` | any (nullable) | |
|     `resolvers` | object | |
|       `primary` | any (nullable) | |
|       `secondary` | any (nullable) | |
|     `subnet` | any (nullable) | |
|     `from` | integer | |
|     `to` | integer | |
|     `restricted` | array | |
|     `total` | integer | |
|     `generatedTotal` | integer | |
|     `usedTotal` | integer | |
|     `freeTotal` | integer | |
|     `freeGenerated` | integer | |
|     `blacklistedTotal` | integer | |
|   `rdnsType` | integer | |
|   `rdnsZoneId` | any (nullable) | |
|   `networkProfile` | integer | |
|   `routeBlock` | any (nullable) | |
|   `dhcp` | integer | |
|   `enabled` | boolean | |
|   `created` | string | |
|   `updated` | string | |

#### Response `401`

---

## Backups

### GET `/backups/server/{serverId}`

**Retrieve a server backups**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | array[object] | |
|   `id` | integer | |
|   `serverId` | integer | |
|   `storage` | object | |
|     `id` | integer | |
|     `name` | string | |
|     `enabled` | boolean | |
|   `deleting` | boolean | |
|   `restoring` | boolean | |
|   `progress` | boolean | |
|   `complete` | boolean | |
|   `deleteAfter` | any (nullable) | |
|   `created` | string | |
|   `updated` | string | |

#### Response `401`

---

## DNS

### GET `/dns/services/{serviceId}`

**Retrieve a DNS service**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serviceId` | string | Yes | A valid DNS service ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `type` | integer | |
|   `name` | string | |
|   `username` | string | |
|   `url` | string | |
|   `ip` | any (nullable) | |
|   `port` | integer | |
|   `password` | string | |
|   `config` | object | |
|   `subAccount` | boolean | |
|   `capabilities` | integer | |
|   `enabled` | boolean | |
|   `created` | string | |
|   `updated` | string | |

#### Response `401`

---

## Media

### GET `/media/iso/{isoId}`

**Retrieve an ISO**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `isoId` | string | Yes | A valid ISO ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `name` | string | |
|   `description` | any (nullable) | |
|   `arch` | integer | |
|   `url` | string | |
|   `filename` | string | |
|   `enabled` | boolean | |
|   `config` | string | |
|   `global` | boolean | |
|   `download` | boolean | |
|   `users` | array | |
|   `created` | string | |
|   `updated` | string | |

#### Response `401`

---

### GET `/media/templates/fromServerPackageSpec/{serverPackageId}`

**Retrieve operating system templates that are available for a package**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `serverPackageId` | integer | Yes | A valid server package ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | array[object] | |
|   `name` | string | |
|   `description` | string | |
|   `icon` | string | |
|   `templates` | array[object] | |
|     `id` | integer | |
|     `name` | string | |
|     `version` | string | |
|     `variant` | string | |
|     `arch` | integer | |
|     `description` | string | |
|     `icon` | string | |
|     `eol` | boolean | |
|     `eol_date` | string | |
|     `eol_warning` | boolean | |
|     `deploy_type` | integer | |
|     `vnc` | boolean | |
|     `type` | string | |
|   `id` | integer | |

#### Response `401`

---

## Packages

### GET `/packages`

**Retrieve packages**

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | array[object] | |
|   `id` | integer | |
|   `name` | string | |
|   `description` | any (nullable) | |
|   `enabled` | boolean | |
|   `memory` | integer | |
|   `primaryStorage` | integer | |
|   `traffic` | integer | |
|   `cpuCores` | integer | |
|   `primaryNetworkSpeedIn` | integer | |
|   `primaryNetworkSpeedOut` | integer | |
|   `primaryDiskType` | string | |
|   `backupPlanId` | integer | |
|   `primaryStorageReadBytesSec` | any (nullable) | |
|   `primaryStorageWriteBytesSec` | any (nullable) | |
|   `primaryStorageReadIopsSec` | any (nullable) | |
|   `primaryStorageWriteIopsSec` | any (nullable) | |
|   `primaryStorageProfile` | integer | |
|   `primaryNetworkProfile` | integer | |
|   `created` | string | |

#### Response `401`

---

### GET `/packages/{packageId}`

**Retrieve a packge**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `packageId` | integer | Yes | A valid package ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `name` | string | |
|   `description` | any (nullable) | |
|   `enabled` | boolean | |
|   `memory` | integer | |
|   `primaryStorage` | integer | |
|   `traffic` | integer | |
|   `cpuCores` | integer | |
|   `primaryNetworkSpeedIn` | integer | |
|   `primaryNetworkSpeedOut` | integer | |
|   `primaryDiskType` | string | |
|   `backupPlanId` | integer | |
|   `primaryStorageReadBytesSec` | any (nullable) | |
|   `primaryStorageWriteBytesSec` | any (nullable) | |
|   `primaryStorageReadIopsSec` | any (nullable) | |
|   `primaryStorageWriteIopsSec` | any (nullable) | |
|   `primaryStorageProfile` | integer | |
|   `primaryNetworkProfile` | integer | |
|   `created` | string | |

#### Response `401`

---

## Queue & Tasks

### GET `/queue/{queueId}`

**Retrieve a queue item**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `queueId` | integer | Yes | A valid queue ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `jobId` | string | |
|   `job` | string | |
|   `hypervisorId` | integer | |
|   `serverId` | integer | |
|   `action` | string | |
|   `queue` | string | |
|   `started` | string | |
|   `updated` | string | |
|   `finished` | string | |
|   `failed` | boolean | |
|   `progress` | integer | |
|   `errors` | object | |
|     `exception` | object | |
|       `stringable` | boolean | |
|       `errors` | array | |
|       `type` | any (nullable) | |
|       `trace` | any (nullable) | |
|       `message` | any (nullable) | |
|   `primaryActions` | array[object] | |
|     `type` | string | |
|     `dataType` | string | |
|     `data` | object | |
|       `success` | boolean | |
|       `version` | string | |
|       `setOpts` | object | |
|         `failOnVersionCheck` | boolean | |
|         `failOnDisasterRecovery` | boolean | |
|         `createDirStructure` | boolean | |
|         `writeXMLConfiguration` | boolean | |
|         `failOnCustomXML` | boolean | |
|         `failOnPriorityXML` | boolean | |
|         `failOnElevateXML` | boolean | |
|       `actions` | object | |
|         `createDirStructure` | object | |
|           `requested` | boolean | |
|           `output` | string | |
|           `msg` | any (nullable) | |
|           `success` | boolean | |
|       `statusTree` | object | |
|         `disasterRecoveryActive` | boolean | |
|         `customXML` | boolean | |
|         `priorityXML` | boolean | |
|         `elevateXML` | boolean | |
|     `created` | string | |
|     `updated` | string | |
|   `subActions` | array | |

#### Response `401`

---

## SSH Keys

### POST `/ssh_keys`

**Add an SSH key to a user account**

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `userId` | integer | Yes |  |
| `name` | string | Yes |  |
| `publicKey` | string | Yes |  |

#### Response `201`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `name` | string | |
|   `type` | string | |
|   `createdAt` | string | |

#### Response `401`

---

### DELETE `/ssh_keys/{keyId}`

**Delete an SSH key from a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `keyId` | integer | Yes | A valid SSH key ID as shown in VirtFusion. |

#### Response `204`

#### Response `401`

---

### GET `/ssh_keys/{keyId}`

**Retrieve an SSH key**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `keyId` | integer | Yes | A valid SSH key ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `name` | string | |
|   `publicKey` | string | |
|   `type` | string | |
|   `enabled` | boolean | |
|   `created` | string | |
|   `updated` | string | |

#### Response `401`

---

### GET `/ssh_keys/user/{userId}`

**Retrieve a users SSH keys**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `userId` | integer | Yes | A valid user ID as shown in VirtFusion. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | array[object] | |
|   `id` | integer | |
|   `name` | string | |
|   `publicKey` | string | |
|   `type` | string | |
|   `enabled` | boolean | |
|   `created` | string | |
|   `updated` | string | |

#### Response `401`

---

## Users

### POST `/users`

**Create a user**

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `name` | string | Yes | Full name of the user. |
| `email` | string | Yes | Email address of the user. |
| `extRelationId` | integer | No | Relation ID. |
| `relStr` | string | No | Relational string. |
| `selfService` | integer | No | (default disabled) 0 = disabled, 1 = hourly, 2 = resource packs, 3 = hourly & resource packs. |
| `selfServiceHourlyCredit` | boolean | No |  Enable/disable credit balance billing for hourly self service. (true|false). |
| `selfServiceHourlyGroupProfiles` | array[integer] | No | (default none) array of self service hourly group profile ids. |
| `selfServiceResourceGroupProfiles` | array[integer] | No |  (default none) array of self service resource group profile ids. |
| `selfServiceHourlyResourcePack` | integer | No |  (default none) ID of an hourly self service resource pack. |
| `sendMail` | boolean | No | (default false) Email the access credentials to the user. (true|false). |

#### Response `201`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `admin` | boolean | |
|   `extRelationId` | integer | |
|   `selfService` | integer | |
|   `selfServiceHourlyGroupProfiles` | array | |
|   `selfServiceResourceGroupProfiles` | array | |
|   `selfServiceHourlyResourcePack` | any (nullable) | |
|   `name` | string | |
|   `email` | string | |
|   `timezone` | string | |
|   `suspended` | boolean | |
|   `twoFactorAuth` | boolean | |
|   `created` | string | |
|   `updated` | string | |
|   `password` | string | |

#### Response `401`

---

## Users/External Rel ID & Rel Str

### DELETE `/users/{extRelationId}/byExtRelation`

**Delete a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Response `204`

#### Response `401`

---

### PUT `/users/{extRelationId}/byExtRelation`

**Modify a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `name` | string | No | Full name of the user. |
| `email` | string | No | Email address of the user. |
| `selfService` | integer | No | default disabled) 0 = disabled, 1 = hourly, 2 = resource packs, 3 = hourly & resource packs. |
| `selfServiceHourlyCredit` | boolean | No | Enable/disable credit balance billing for hourly self service. (true|false). |
| `selfServiceHourlyGroupProfiles` | array[integer] | No | (default none) array of self service hourly group profile ids. |
| `selfServiceResourceGroupProfiles` | array[integer] | No | (default none) array of self service resource group profile ids. |
| `selfServiceHourlyResourcePack` | integer | No | (default none) ID of an hourly self service resource pack. |
| `enabled` | boolean | No | (default false) Email the access credentials to the user. (true|false). |

#### Response `201`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `name` | string | |
|   `email` | string | |
|   `selfService` | integer | |
|   `enabled` | boolean | |

#### Response `401`

---

### GET `/users/{extRelationId}/byExtRelation`

**Retrieve a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |
|   `admin` | boolean | |
|   `extRelationId` | integer | |
|   `selfService` | integer | |
|   `selfServiceHourlyGroupProfiles` | array | |
|   `selfServiceResourceGroupProfiles` | array | |
|   `selfServiceHourlyResourcePack` | any (nullable) | |
|   `name` | string | |
|   `email` | string | |
|   `timezone` | string | |
|   `suspended` | boolean | |
|   `twoFactorAuth` | boolean | |
|   `created` | string | |
|   `updated` | string | |

#### Response `401`

---

### POST `/users/{extRelationId}/authenticationTokens`

**Generate a set of login tokens**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `authentication` | object | |
|     `tokens` | object | |
|       `1` | string | |
|       `2` | string | |
|     `endpoint` | string | |
|     `endpoint_complete` | string | |
|     `expiry` | object | |
|       `ttl` | integer | |
|       `expires` | string | |

#### Response `401`

---

### POST `/users/{extRelationId}/serverAuthenticationTokens/{serverId}`

**Generate a set of loging tokens using a server ID**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |
| `serverId` | integer | Yes | A valid server ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `authentication` | object | |
|     `tokens` | object | |
|       `1` | string | |
|       `2` | string | |
|     `endpoint` | string | |
|     `endpoint_complete` | string | |
|     `expiry` | object | |
|       `ttl` | integer | |
|       `expires` | string | |

#### Response `401`

---

### POST `/users/{extRelationId}/byExtRelation/resetPassword`

**Change a user passowrd**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Response `201`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `email` | string | |
|   `password` | string | |

#### Response `401`

---

## Self Service

### DELETE `/selfService/credit/{creditId}`

**Cancel credit that was applied to a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `creditId` | integer | Yes | A valid credit ID. |

#### Response `204`

#### Response `401`

---

### DELETE `/selfService/resourcePackServers/{packId}`

**Delete all servers attached to a pack ID**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `packId` | integer | Yes | ID of a resource pack. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `delay` | integer | No | The delay in minutes. Defaults to 30 (0 - 43800). |

#### Response `204`

#### Response `401`

---

### DELETE `/selfService/resourcePack/{packId}`

**Delete a user resource pack**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `packId` | integer | Yes | ID of a resource pack. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `disable` | boolean | No | Disable the pack if it can't be deleted. true|false Defaults to false. |

#### Response `204`

#### Response `401`

---

### GET `/selfService/resourcePack/{packId}`

**Retrieve a user resource pack**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `packId` | integer | Yes | ID of a resource pack. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `withServers` | boolean | No | include a list of assigned servers. true|false Defaults to false. |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `type` | string | |
|   `id` | integer | |
|   `pid` | integer | |
|   `label` | any (nullable) | |
|   `name` | string | |
|   `limits` | object | |
|     `total_servers` | integer | |
|     `total_memory` | integer | |
|     `total_storage` | integer | |
|     `total_cpu` | integer | |
|     `total_traffic` | integer | |
|     `max_memory` | integer | |
|     `max_storage` | integer | |
|     `max_cpu` | integer | |
|     `max_traffic` | integer | |
|   `used` | object | |
|     `servers` | integer | |
|     `memory` | integer | |
|     `storage` | integer | |
|     `cpu` | integer | |
|     `traffic` | integer | |
|   `usage` | object | |
|     `servers` | object | |
|       `t` | integer | |
|       `u` | integer | |
|       `f` | integer | |
|       `p` | integer | |
|       `l` | boolean | |
|     `memory` | object | |
|       `t` | integer | |
|       `u` | integer | |
|       `f` | integer | |
|       `p` | integer | |
|       `l` | boolean | |
|     `storage` | object | |
|       `t` | integer | |
|       `u` | integer | |
|       `f` | integer | |
|       `p` | integer | |
|       `l` | boolean | |
|     `cpu` | object | |
|       `t` | integer | |
|       `u` | integer | |
|       `p` | integer | |
|       `f` | integer | |
|       `l` | boolean | |
|     `traffic` | object | |
|       `t` | integer | |
|       `u` | integer | |
|       `f` | integer | |
|       `p` | integer | |
|       `l` | boolean | |

#### Response `401`

---

### PUT `/selfService/resourcePack/{packId}`

**Modify user resource pack**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `packId` | integer | Yes | ID of a resource pack. |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `enabled` | boolean | Yes |  |

#### Response `204`

#### Response `401`

---

### GET `/selfService/currencies`

**Retrieve currencies**

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | array[object] | |
|   `id` | integer | |
|   `code` | string | |
|   `value` | string | |
|   `prefix` | string | |
|   `suffix` | any (nullable) | |
|   `default` | boolean | |
|   `enabled` | boolean | |

#### Response `401`

---

### POST `/selfService/resourcePackServers/{packId}/suspend`

**Suspend all servers assigned to a reosurce pack**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `packId` | integer | Yes | ID of a resource pack. |

#### Response `204`

#### Response `401`

---

### POST `/selfService/resourcePackServers/{packId}/unsuspend`

**Unsuspend all servers assigned to a reosurce pack**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `packId` | integer | Yes | ID of a resource pack. |

#### Response `204`

#### Response `401`

---

## Self Service/External Relational ID

### POST `/selfService/credit/byUserExtRelationId/{extRelationId}`

**Add credit to user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `tokens` | number | Yes | A numeric token value. |
| `reference_1` | integer | No |  An optional reference number. Max 64-bit integer. |
| `reference_2` | string | No | An optional reference in string format. Max 1000 character. |

#### Response `201`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |

#### Response `401`

---

### POST `/selfService/hourlyGroupProfile/byUserExtRelationId/{extRelationId}`

**Add an hourly group profile to a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `profileId` | integer | Yes | ID of an hourly group profile. |

#### Response `204`

#### Response `401`

---

### POST `/selfService/resourceGroupProfile/byUserExtRelationId/{extRelationId}`

**Add a resource group profile to a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `profileId` | integer | Yes | ID a resource group profile. |

#### Response `204`

#### Response `401`

---

### POST `/selfService/resourcePack/byUserExtRelationId/{extRelationId}`

**Add a resource pack to a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `packId` | integer | Yes | ID of a resource pack. |
| `enabled` | boolean | Yes | Enable the pack. true|false defaults too true. |

#### Response `201`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `id` | integer | |

#### Response `401`

---

### GET `/selfService/hourlyStats/byUserExtRelationId/{extRelationId}`

**Retrieve hourly statistics**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `period[]` | string | No | Example: period[]=YYYY-MM-DD&period[]=YYYY-MM-D |
| `range` | string | No | range=m |
| `relStr` | boolean | No |  |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `periodId` | integer | |
|   `period` | string | |
|   `previousPeriod` | string | |
|   `nextPeriod` | string | |
|   `monthlyTotal` | object | |
|     `hours` | integer | |
|     `value` | string | |
|     `tokens` | boolean | |
|   `servers` | integer | |
|   `credit` | object | |
|     `value` | integer | |
|   `currency` | object | |
|     `code` | string | |
|     `prefix` | string | |
|     `suffix` | string | |
|     `value` | integer | |
|     `currentValue` | integer | |

#### Response `401`

---

### PUT `/selfService/access/byUserExtRelationId/{extRelationId}`

**Modify user access**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `syncToProfiles` | boolean | Yes | true|false Default false. If true, the self service access level will be set based on profiles. |

#### Response `204`

#### Response `401`

---

### DELETE `/selfService/hourlyGroupProfile/{profileId}/byUserExtRelationId/{extRelationId}`

**Remove hourly group profile from a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `profileId` | integer | Yes | ID of a hourly group profile. |
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Response `204`

#### Response `401`

---

### DELETE `/selfService/resourceGroupProfile/{profileId}/byUserExtRelationId/{extRelationId}`

**Remove resource group from a user**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `profileId` | integer | Yes | ID of a hourly group profile. |
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Response `204`

#### Response `401`

---

### GET `/selfService/report/byUserExtRelationId/{extRelationId}`

**Generate a report**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `period` | string | No | A single period in the range of 0-24 (0 being the currently defined month in the self service settings | optional and will default to the current month if not defined). |
| `currency` | string | No | A three letter currency code that is defined in the self service settings. (optional and will default to the user defined currency if not defined). |
| `relStr` | boolean | No |  |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `usage` | object | |
|     `servers` | array | |
|     `serversTotal` | object | |
|       `hours` | boolean | |
|       `value` | boolean | |
|       `tokens` | boolean | |
|     `hourConversionRate` | boolean | |
|     `monthlyTotal` | object | |
|       `hours` | boolean | |
|       `value` | boolean | |
|       `tokens` | boolean | |
|     `addonsTotal` | object | |
|       `hours` | integer | |
|       `value` | integer | |
|       `tokens` | boolean | |
|     `taxStatus` | integer | |
|     `success` | boolean | |
|     `history` | string | |
|     `breakdown` | boolean | |
|     `term` | string | |
|     `previousTerm` | string | |
|     `nextTerm` | string | |
|     `period` | object | |
|       `ymd` | string | |
|       `start` | string | |
|       `end` | string | |
|     `showHourlyRate` | boolean | |
|     `showMonthlyRate` | boolean | |
|   `currency` | object | |
|     `prefix` | string | |
|     `suffix` | string | |
|     `code` | string | |
|     `currentValue` | integer | |
|     `value` | integer | |
|     `default` | object | |
|       `prefix` | string | |
|       `suffix` | string | |
|       `code` | string | |
|   `limits` | object | |
|     `success` | boolean | |
|     `packs` | array | |

#### Response `401`

---

### PUT `/selfService/hourlyResourcePack/byUserExtRelationId/{extRelationId}`

**Set an hourly resource pack**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `relStr` | boolean | No |  |

#### Request Body

Content-Type: `application/json`

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `packId` | integer | Yes | ID of an hourly resource pack. |

#### Response `204`

#### Response `401`

---

### GET `/selfService/usage/byUserExtRelationId/{extRelationId}`

**Retrieve a users usage**

#### Path Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `extRelationId` | string | Yes | A valid external relational ID as shown in VirtFusion. |

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `period[]` | string | No | Array of periods or a single period. (YYYY-MM-DD). |
| `range` | string | No | Length of period. Defaults to 1 month. Possible values d = day, w = week, 2w = 2 weeks, 3w = 3 weeks, m = month. |
| `relStr` | boolean | No |  |

#### Response `200`

| Field | Type | Description |
|-------|------|-------------|
| `data` | object | |
|   `user` | object | |
|     `id` | integer | |
|     `relationalId` | integer | |
|     `currency` | any (nullable) | |
|     `timezone` | string | |
|     `name` | string | |
|     `email` | string | |
|   `usageServers` | object | |
|     `hours` | integer | |
|     `token` | integer | |
|     `tokenReal` | integer | |
|   `usageServersBillable` | object | |
|     `hours` | integer | |
|     `token` | integer | |
|     `tokenReal` | integer | |
|   `usageAddons` | object | |
|     `hours` | integer | |
|     `token` | integer | |
|     `tokenReal` | integer | |
|   `usageAddonsBillable` | object | |
|     `hours` | integer | |
|     `token` | integer | |
|     `tokenReal` | integer | |
|   `periods` | array[object] | |
|     `period` | string | |
|     `range` | string | |
|     `start` | string | |
|     `end` | string | |
|     `timezone` | string | |
|     `currentPeriod` | boolean | |
|     `hoursInMonthPeriod` | integer | |
|     `monthToHourRate` | integer | |
|     `monthToHourRateType` | integer | |
|     `days` | integer | |
|     `hours` | integer | |
|     `minutes` | integer | |
|     `seconds` | integer | |
|     `usageServers` | object | |
|       `hours` | integer | |
|       `token` | integer | |
|       `tokenReal` | integer | |
|     `usageServersBillable` | object | |
|       `hours` | integer | |
|       `token` | integer | |
|       `tokenReal` | integer | |
|     `usageAddons` | object | |
|       `hours` | integer | |
|       `token` | integer | |
|       `tokenReal` | integer | |
|     `usageAddonsBillable` | object | |
|       `hours` | integer | |
|       `token` | integer | |
|       `tokenReal` | integer | |
|     `servers` | array | |

#### Response `401`

---
