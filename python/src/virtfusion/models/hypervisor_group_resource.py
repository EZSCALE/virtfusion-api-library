from __future__ import annotations

from dataclasses import dataclass, field
from typing import Any


@dataclass(frozen=True, slots=True)
class HypervisorGroupResource:
    hypervisor_id: int
    hypervisor_name: str
    hypervisor: dict[str, Any]
    resources: dict[str, Any]
    raw: dict[str, Any] = field(default_factory=dict, repr=False)

    @classmethod
    def from_dict(cls, data: dict[str, Any]) -> HypervisorGroupResource:
        hv: dict[str, Any] = data.get("hypervisor", {})
        return cls(
            hypervisor_id=hv.get("id") or data.get("id", 0),
            hypervisor_name=hv.get("name") or data.get("name", ""),
            hypervisor=hv,
            resources=data.get("resources", {}),
            raw=data,
        )
