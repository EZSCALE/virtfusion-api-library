from __future__ import annotations

import re

from .._http import HttpClient
from ..models.action_result import ActionResult
from ..models.firewall_config import FirewallConfig


class ServerFirewallBuilder:
    def __init__(self, http: HttpClient, server_id: int, interface: str) -> None:
        if not re.match(r"^[a-zA-Z0-9_-]+$", interface):
            raise ValueError(
                f"Invalid interface name: '{interface}'. "
                "Only alphanumeric, hyphens, and underscores are allowed."
            )
        self._http = http
        self._server_id = server_id
        self._interface = interface

    def get(self) -> FirewallConfig:
        data = self._http.request(
            "GET", f"servers/{self._server_id}/firewall/{self._interface}"
        )
        return FirewallConfig.from_dict(data.get("data", data))

    def enable(self) -> ActionResult:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/firewall/{self._interface}/enable"
        )
        return ActionResult.from_dict(data)

    def disable(self) -> ActionResult:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/firewall/{self._interface}/disable"
        )
        return ActionResult.from_dict(data)

    def apply_rules(self, rule_ids: list[int]) -> ActionResult:
        data = self._http.request(
            "POST",
            f"servers/{self._server_id}/firewall/{self._interface}/rules",
            json={"rules": rule_ids},
        )
        return ActionResult.from_dict(data)
