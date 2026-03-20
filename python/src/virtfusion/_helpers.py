from __future__ import annotations

from typing import Any


def unwrap_data(response: dict[str, Any]) -> dict[str, Any]:
    inner = response.get("data")
    if isinstance(inner, dict):
        return inner
    return response


def unwrap_list(response: dict[str, Any]) -> list[Any]:
    inner = response.get("data")
    if isinstance(inner, list):
        return inner
    return []
