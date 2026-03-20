from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class HypervisorGroup:
    id: int
    name: str
    description: str | None
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> HypervisorGroup:
        return cls(
            id=data["id"],
            name=data.get("name", ""),
            description=data.get("description"),
            raw=data,
        )
