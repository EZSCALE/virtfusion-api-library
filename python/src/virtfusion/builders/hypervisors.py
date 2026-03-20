from __future__ import annotations

from .._http import HttpClient
from ..models.hypervisor import Hypervisor
from ..models.paginated_response import PaginatedResponse
from .hypervisor_groups import HypervisorGroupsBuilder


class HypervisorsBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def list(self, results: int = 20) -> PaginatedResponse:
        data = self._http.request(
            "GET", "compute/hypervisors", params={"results": results}
        )
        return PaginatedResponse.from_dict(data, Hypervisor.from_dict)

    def get(self, hypervisor_id: int) -> Hypervisor:
        data = self._http.request("GET", f"compute/hypervisors/{hypervisor_id}")
        return Hypervisor.from_dict(data.get("data", data))

    def groups(self) -> HypervisorGroupsBuilder:
        return HypervisorGroupsBuilder(self._http)
