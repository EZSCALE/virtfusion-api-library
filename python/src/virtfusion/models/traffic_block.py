from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class TrafficBlock:
    id: int
    ip: str
    reason: str | None
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> TrafficBlock:
        return cls(
            id=data["id"],
            ip=data.get("ip", ""),
            reason=data.get("reason"),
            raw=data,
        )
