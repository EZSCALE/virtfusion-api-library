from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class FirewallRule:
    id: int
    action: str
    protocol: str
    port: str | None
    source: str | None
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> FirewallRule:
        return cls(
            id=data["id"],
            action=data.get("action", ""),
            protocol=data.get("protocol", ""),
            port=data.get("port"),
            source=data.get("source"),
            raw=data,
        )
