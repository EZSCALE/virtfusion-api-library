from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class SshKey:
    id: int
    name: str
    public_key: str | None
    type: str
    enabled: bool
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> SshKey:
        return cls(
            id=data["id"],
            name=data.get("name", ""),
            public_key=data.get("publicKey") or data.get("public_key") or data.get("public"),
            type=data.get("type", ""),
            enabled=data.get("enabled", True),
            raw=data,
        )
