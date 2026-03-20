from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class Server:
    id: int
    name: str
    hostname: str | None
    state: str
    package_id: int | None
    primary_ip: str | None
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> Server:
        return cls(
            id=data["id"],
            name=data.get("name", ""),
            hostname=data.get("hostname"),
            state=data.get("state", ""),
            package_id=data.get("packageId") or data.get("package_id"),
            primary_ip=data.get("primaryIp") or data.get("primary_ip"),
            raw=data,
        )
