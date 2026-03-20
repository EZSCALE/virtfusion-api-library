# VirtFusion API Libraries — Monorepo

## Structure
- Root: shared docs (README, LICENSE, SECURITY)
- `php/`: PHP SDK (`ezscale/virtfusion-php`)
- Future: `python/`, `node/`

## Conventions
- Each SDK lives in its own subdirectory with its own package manifest
- Shared license (MIT) at root
- PHP SDK targets PHP 8.2+ with readonly classes, match expressions, constructor promotion
- Fluent builder pattern: `$vf->server(69)->boot()`
- All DTOs carry a `$raw` array for forward-compatibility
