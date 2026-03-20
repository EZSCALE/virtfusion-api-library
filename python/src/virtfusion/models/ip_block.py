from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class IpBlock:
    id: int
    name: str
    type: int
    enabled: bool
    ipv4: dict[str, Any]
    ipv6: dict[str, Any]
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> IpBlock:
        return cls(
            id=data["id"],
            name=data.get("name", ""),
            type=data.get("type", 0),
            enabled=data.get("enabled", False),
            ipv4=data.get("ipv4", {}),
            ipv6=data.get("ipv6", {}),
            raw=data,
        )
