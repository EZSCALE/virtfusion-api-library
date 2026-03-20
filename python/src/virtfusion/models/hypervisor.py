from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class Hypervisor:
    id: int
    name: str
    ip: str
    hostname: str | None
    enabled: bool
    maintenance: bool
    max_servers: int
    max_cpu: int
    max_memory: int
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> Hypervisor:
        return cls(
            id=data["id"],
            name=data.get("name", ""),
            ip=data.get("ip", ""),
            hostname=data.get("hostname"),
            enabled=data.get("enabled", False),
            maintenance=data.get("maintenance", False),
            max_servers=data.get("maxServers") or data.get("max_servers", 0),
            max_cpu=data.get("maxCpu") or data.get("max_cpu", 0),
            max_memory=data.get("maxMemory") or data.get("max_memory", 0),
            raw=data,
        )
