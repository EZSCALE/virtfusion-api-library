from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class Package:
    id: int
    name: str
    description: str | None
    enabled: bool
    memory: int
    primary_storage: int
    traffic: int
    cpu_cores: int
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> Package:
        return cls(
            id=data["id"],
            name=data.get("name", ""),
            description=data.get("description"),
            enabled=data.get("enabled", False),
            memory=data.get("memory", 0),
            primary_storage=data.get("primaryStorage") or data.get("primary_storage", 0),
            traffic=data.get("traffic", 0),
            cpu_cores=data.get("cpuCores") or data.get("cpu_cores", 0),
            raw=data,
        )
