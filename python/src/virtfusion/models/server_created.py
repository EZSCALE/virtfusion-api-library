from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class ServerCreated:
    id: int
    name: str
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> ServerCreated:
        return cls(
            id=data["id"],
            name=data.get("name", ""),
            raw=data,
        )
