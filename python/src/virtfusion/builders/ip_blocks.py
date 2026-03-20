from __future__ import annotations

from .._http import HttpClient
from ..models.action_result import ActionResult
from ..models.ip_block import IpBlock
from ..models.paginated_response import PaginatedResponse


class IpBlocksBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def list(self, results: int = 20) -> PaginatedResponse:
        data = self._http.request(
            "GET", "connectivity/ipblocks", params={"results": results}
        )
        return PaginatedResponse.from_dict(data, IpBlock.from_dict)

    def get(self, block_id: int) -> IpBlock:
        data = self._http.request("GET", f"connectivity/ipblocks/{block_id}")
        return IpBlock.from_dict(data.get("data", data))

    def add_ipv4_range(
        self, block_id: int, start: str, end: str
    ) -> ActionResult:
        data = self._http.request(
            "POST",
            f"connectivity/ipblocks/{block_id}/ipv4",
            json={"type": "range", "start": start, "end": end},
        )
        return ActionResult.from_dict(data)
