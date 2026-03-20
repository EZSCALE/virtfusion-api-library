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
$vf->server(69)->suspend();
$vf->server(69)->unsuspend();
$vf->server(69)->delete(delay: 30);

// Build / modify
$vf->server(69)->build(['reinstall' => true]);
$vf->server(69)->changePackage(5);
$vf->server(69)->modifyBackupPlan(2);
$vf->server(69)->modifyName('new-hostname');
$vf->server(69)->modifyCpuCores(4);
$vf->server(69)->modifyCpuThrottle(50, sync: true);
$vf->server(69)->modifyMemory(4096);
$vf->server(69)->changeOwner(42);

// Password / VNC
$vf->server(69)->resetPassword('root');
$vf->server(69)->vnc();
$vf->server(69)->enableVnc();
$vf->server(69)->disableVnc();

// Templates / Traffic stats
$vf->server(69)->templates();
$vf->server(69)->traffic();

// Custom XML
$vf->server(69)->customXml(['domain' => '<xml/>', 'domainEnabled' => true]);

// Network
$vf->server(69)->addIpv4(['ips' => ['10.0.0.1']]);
$vf->server(69)->removeIpv4(['ips' => ['10.0.0.1']]);
$vf->server(69)->addIpv4Quantity(['quantity' => 1]);
$vf->server(69)->addToWhitelist(['ips' => ['1.2.3.4']]);
$vf->server(69)->removeFromWhitelist(['ips' => ['1.2.3.4']]);
$vf->server(69)->modifyTraffic(['limit' => 1000]);

// Firewall (sub-builder)
$vf->server(69)->firewall('primary')->get();       // FirewallConfig
$vf->server(69)->firewall('primary')->enable();
$vf->server(69)->firewall('primary')->disable();
$vf->server(69)->firewall('primary')->applyRules([1, 2, 5]);

// Traffic blocks (sub-builder)
$vf->server(69)->trafficBlocks()->list();           // TrafficBlock[]
$vf->server(69)->trafficBlocks()->add(['ip' => '1.2.3.4']);
$vf->server(69)->trafficBlocks()->remove(42);

// List servers
$vf->listServers();
$vf->listServersByUser(1);
$vf->createServer(['packageId' => 1, 'name' => 'web1']);

// Hypervisors
$vf->hypervisors()->list();
$vf->hypervisors()->get(1);                         // Hypervisor DTO
$vf->hypervisorGroups()->list();
$vf->hypervisorGroups()->group(3)->get();
$vf->hypervisorGroups()->group(3)->resources();

// Packages
$vf->packages()->list();                            // Package[]
$vf->packages()->get(1);                            // Package DTO

// Users
$vf->users()->create(['name' => 'John', 'email' => 'john@example.com']);
$vf->users()->getByExtRelation('100');               // User DTO
$vf->users()->updateByExtRelation('100', ['name' => 'Jane']);
$vf->users()->deleteByExtRelation('100');
$vf->users()->resetPasswordByExtRelation('100');
$vf->users()->authenticationTokens('100');
$vf->users()->serverAuthenticationTokens('100', 69);

// SSH Keys
$vf->sshKeys()->create(1, 'my-key', 'ssh-rsa AAAA...');
$vf->sshKeys()->get(1);                             // SshKey DTO
$vf->sshKeys()->listByUser(1);                      // SshKey[]
$vf->sshKeys()->delete(1);

// IP Blocks
$vf->ipBlocks()->list();                             // PaginatedResponse
$vf->ipBlocks()->get(1);                             // IpBlock DTO
$vf->ipBlocks()->addIpv4Range(1, '10.0.0.10', '10.0.0.20');

// Backups
$vf->backups()->listByServer(69);                    // Backup[]

// DNS
$vf->dns()->getService(1);

// Media
$vf->media()->getIso(1);
$vf->media()->templatesFromPackageSpec(5);

// Queue
$vf->queue()->get(42);

// Self Service
$vf->selfService()->addCredit('100', 50.0);
$vf->selfService()->deleteCredit(1);
$vf->selfService()->currencies();
$vf->selfService()->createResourcePack('100', 5);
$vf->selfService()->getResourcePack(5, withServers: true);
$vf->selfService()->usage('100');
$vf->selfService()->report('100');
$vf->selfService()->hourlyStats('100');
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

## API Reference

See [API_REFERENCE.md](API_REFERENCE.md) for the complete VirtFusion API specification.

## License

MIT — see [LICENSE](../LICENSE).
