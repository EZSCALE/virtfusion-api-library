from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class Backup:
    id: int
    server_id: int
    complete: bool
    restoring: bool
    deleting: bool
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> Backup:
        return cls(
            id=data["id"],
            server_id=data.get("serverId") or data.get("server_id", 0),
            complete=data.get("complete", False),
            restoring=data.get("restoring", False),
            deleting=data.get("deleting", False),
            raw=data,
        )
