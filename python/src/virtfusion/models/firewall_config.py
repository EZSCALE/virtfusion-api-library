from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any

from .firewall_rule import FirewallRule


@dataclass(frozen=True, slots=True)
class FirewallConfig:
    enabled: bool
    interface: str
    rules: list[FirewallRule]
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> FirewallConfig:
        rules = [FirewallRule.from_dict(r) for r in data.get("rules", [])]
        return cls(
            enabled=data.get("enabled", False),
            interface=data.get("interface", ""),
            rules=rules,
            raw=data,
        )
