# VirtFusion Python SDK

Python SDK for the [VirtFusion](https://virtfusion.com) API (v1). Built for VirtFusion 6.2+.

## Installation

```bash
pip install ezscale-virtfusion
```

## Quick Start

```python
from virtfusion import VirtFusion

vf = VirtFusion("https://cp.domain.com", "your-api-token")

# Test connection
result = vf.test_connection()
print(result.message)

# Server operations
server = vf.server(69).get()
vf.server(69).boot()
vf.server(69).shutdown()

# Firewall
fw = vf.server(69).firewall("primary").get()
vf.server(69).firewall("primary").enable()

# List resources
packages = vf.packages().list()
hypervisors = vf.hypervisors().list()

# User management
user = vf.users().get_by_ext_relation("100")
vf.users().create({"name": "John", "email": "john@example.com", "extRelationId": 1})

# Context manager
with VirtFusion("https://cp.domain.com", "token") as vf:
    vf.server(69).boot()
```

## Requirements

- Python 3.10+
- httpx

## License

MIT - see [LICENSE](../LICENSE) in the repository root.
