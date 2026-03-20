from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any, Callable, TypeVar

T = TypeVar("T")


@dataclass(frozen=True, slots=True)
class PaginatedResponse:
    items: list[Any]
    current_page: int
    last_page: int
    per_page: int
    total: int
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(
        cls,
        data: dict[str, Any],
        item_factory: Callable[[dict[str, Any]], Any],
    ) -> PaginatedResponse:
        items = [item_factory(item) for item in data.get("data", [])]
        meta = data.get("meta", {})
        return cls(
            items=items,
            current_page=data.get("current_page") or meta.get("current_page", 1),
            last_page=data.get("last_page") or meta.get("last_page", 1),
            per_page=data.get("per_page") or meta.get("per_page", 15),
            total=data.get("total") or meta.get("total", len(items)),
            raw=data,
        )
