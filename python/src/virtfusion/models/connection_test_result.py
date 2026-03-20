from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class ConnectionTestResult:
    success: bool
    message: str
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> ConnectionTestResult:
        return cls(
            success=data.get("success", False) is True,
            message=data.get("message", ""),
            raw=data,
        )
