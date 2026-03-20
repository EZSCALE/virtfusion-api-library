# VirtFusion API Libraries — Monorepo

## Structure
- Root: shared docs (README, LICENSE, SECURITY)
- `php/`: PHP SDK (`ezscale/virtfusion-php`)
- Future: `python/`, `node/`

## API Reference
- **`php/API_REFERENCE.md`** — Complete VirtFusion API specification (84 endpoints, 19 resource categories), generated from the official OpenAPI spec. Use this as the source of truth for endpoint paths, parameters, and response shapes.

## PHP SDK Conventions
- PHP 8.2+ with readonly classes, match expressions, constructor promotion
- Fluent builder pattern: `$vf->server(69)->boot()`
- All DTOs carry a `$raw` array for forward-compatibility with unmapped API fields
- DTOs use `fromArray()` named constructors — check both camelCase and snake_case field variants
- Exception hierarchy maps HTTP status codes: 401→Authentication, 403→Authorization, 404→NotFound, 422→Validation (with errors array), 429→RateLimit (with retryAfter), 500+→Server
- Builders live in `src/Builders/`, DTOs in `src/DataObjects/`, exceptions in `src/Exceptions/`
- Entry point is `VirtFusion.php` — exposes builder factory methods
- `HttpClient.php` wraps Guzzle 7 with error mapping
- Tests use Guzzle MockHandler with JSON fixtures in `tests/Fixtures/`

## Naming Patterns
- Builder for a collection: `{Resource}sBuilder` (e.g., `PackagesBuilder`)
- Builder for a single item: `{Resource}Builder` (e.g., `HypervisorGroupBuilder`)
- Sub-builders accessed via parent: `$vf->server(69)->firewall('primary')`
- DTOs match API resource names: `Server`, `Package`, `User`, `Hypervisor`, etc.

## Shared
- Each SDK lives in its own subdirectory with its own package manifest
- Shared license (MIT) at root
- Subtree split workflow pushes `php/` to `EZSCALE/virtfusion-php` on every push to main
