# VirtFusion PHP SDK

PHP SDK for the [VirtFusion](https://virtfusion.com) hosting API.

## Requirements

- PHP 8.2+
- Guzzle 7+

## Installation

```bash
composer require ezscale/virtfusion-php
```

## Quick Start

```php
use EZScale\VirtFusion\VirtFusion;

$vf = new VirtFusion('https://cp.domain.com', 'your-api-token');

// Test connection
$result = $vf->testConnection(); // ConnectionTestResult

// Server operations
$server = $vf->server(69)->get();           // Server DTO
$vf->server(69)->boot();                     // ActionResult
$vf->server(69)->shutdown();                 // ActionResult
$vf->server(69)->restart();                  // ActionResult
$vf->server(69)->powerOff();                 // ActionResult
$vf->server(69)->delete(delay: 30);          // ActionResult

// Build / modify
$vf->server(69)->build(['reinstall' => true]);
$vf->server(69)->changePackage(5);
$vf->server(69)->modifyBackupPlan(2);

// Network
$vf->server(69)->addIpv4(['10.0.0.1']);
$vf->server(69)->removeIpv4(['10.0.0.1']);
$vf->server(69)->addIpv4Quantity(['quantity' => 1]);
$vf->server(69)->addToWhitelist(['1.2.3.4']);
$vf->server(69)->removeFromWhitelist(['1.2.3.4']);
$vf->server(69)->modifyTraffic(['limit' => 1000]);

// Firewall (sub-builder)
$vf->server(69)->firewall('primary')->get();
$vf->server(69)->firewall('primary')->enable();
$vf->server(69)->firewall('primary')->disable();
$vf->server(69)->firewall('primary')->applyRules([1, 2, 5]);

// Traffic blocks (sub-builder)
$vf->server(69)->trafficBlocks()->list();
$vf->server(69)->trafficBlocks()->add(['ip' => '1.2.3.4']);
$vf->server(69)->trafficBlocks()->remove(42);

// Hypervisor groups
$vf->hypervisorGroups()->list();
$vf->hypervisorGroups()->group(3)->get();
$vf->hypervisorGroups()->group(3)->resources();

// Create server
$vf->createServer(['packageId' => 1, 'name' => 'web1']);
```

## Error Handling

```php
use EZScale\VirtFusion\Exceptions\ValidationException;
use EZScale\VirtFusion\Exceptions\RateLimitException;
use EZScale\VirtFusion\Exceptions\NotFoundException;

try {
    $vf->server(999)->get();
} catch (NotFoundException $e) {
    // Server not found
} catch (ValidationException $e) {
    $errors = $e->getErrors(); // field-level errors
} catch (RateLimitException $e) {
    $retryAfter = $e->getRetryAfter(); // seconds
}
```

## License

MIT — see [LICENSE](../LICENSE).
