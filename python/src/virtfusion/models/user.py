from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class User:
    id: int
    name: str
    email: str
    ext_relation_id: int | str | None
    suspended: bool
    self_service: int
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> User:
        return cls(
            id=data["id"],
            name=data.get("name", ""),
            email=data.get("email", ""),
            ext_relation_id=data.get("extRelationId") or data.get("ext_relation_id"),
            suspended=data.get("suspended", False),
            self_service=data.get("selfService") or data.get("self_service", 0),
            raw=data,
        )
