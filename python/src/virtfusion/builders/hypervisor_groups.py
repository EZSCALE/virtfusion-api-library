from __future__ import annotations

from .._http import HttpClient
from ..models.hypervisor_group import HypervisorGroup
from ..models.paginated_response import PaginatedResponse
from .hypervisor_group import HypervisorGroupBuilder


class HypervisorGroupsBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def list(self, results: int = 20) -> PaginatedResponse:
        data = self._http.request(
            "GET", "compute/hypervisors/groups", params={"results": results}
        )
        return PaginatedResponse.from_dict(data, HypervisorGroup.from_dict)

    def group(self, group_id: int) -> HypervisorGroupBuilder:
        return HypervisorGroupBuilder(self._http, group_id)
