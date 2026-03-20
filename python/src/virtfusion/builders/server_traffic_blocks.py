from __future__ import annotations

from typing import Any

from .._http import HttpClient
from ..models.action_result import ActionResult
from ..models.traffic_block import TrafficBlock


class ServerTrafficBlocksBuilder:
    def __init__(self, http: HttpClient, server_id: int) -> None:
        self._http = http
        self._server_id = server_id

    def list(self) -> list[TrafficBlock]:
        data = self._http.request(
            "GET", f"servers/{self._server_id}/traffic/blocks"
        )
        return [TrafficBlock.from_dict(b) for b in data.get("data", [])]

    def add(self, params: dict[str, Any]) -> ActionResult:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/traffic/blocks", json=params
        )
        return ActionResult.from_dict(data)

    def remove(self, block_id: int) -> ActionResult:
        data = self._http.request(
            "DELETE", f"servers/{self._server_id}/traffic/blocks/{block_id}"
        )
        return ActionResult.from_dict(data)
