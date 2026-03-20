from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class ActionResult:
    success: bool
    message: str
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> ActionResult:
        return cls(
            success=data.get("success", True) is True,
            message=data.get("message", ""),
            raw=data,
        )
