# VirtFusion API Libraries

Official SDK wrappers for the [VirtFusion](https://virtfusion.com) hosting API, maintained by [EZScale](https://ezscale.cloud).

Built for **VirtFusion 6.2** (API v1).

## Available SDKs

| Language | Package | Status |
|----------|---------|--------|
| PHP      | [`ezscale/virtfusion-php`](php/) | Available |
| Python   | — | Planned |
| Node.js  | — | Planned |

## PHP SDK

```bash
composer require ezscale/virtfusion-php
```

```php
$vf = new \EZScale\VirtFusion\VirtFusion('https://cp.domain.com', 'api-token');

$vf->server(69)->boot();
$vf->packages()->list();
$vf->users()->getByExtRelation('100');
```

Covers all documented VirtFusion API endpoints — servers, hypervisors, packages, users, SSH keys, IP blocks, backups, DNS, media, queue, and self-service. See the [PHP README](php/README.md) for full usage.

## License

MIT — see [LICENSE](LICENSE).
