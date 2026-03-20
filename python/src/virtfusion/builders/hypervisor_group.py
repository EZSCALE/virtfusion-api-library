from __future__ import annotations

from .._http import HttpClient
from ..models.hypervisor_group import HypervisorGroup
from ..models.hypervisor_group_resource import HypervisorGroupResource
from ..models.paginated_response import PaginatedResponse


class HypervisorGroupBuilder:
    def __init__(self, http: HttpClient, group_id: int) -> None:
        self._http = http
        self._group_id = group_id

    def get(self) -> HypervisorGroup:
        data = self._http.request(
            "GET", f"compute/hypervisors/groups/{self._group_id}"
        )
        return HypervisorGroup.from_dict(data.get("data", data))

    def resources(self, page: int = 1) -> PaginatedResponse:
        data = self._http.request(
            "GET",
            f"compute/hypervisors/groups/{self._group_id}/resources",
            params={"page": page},
        )
        return PaginatedResponse.from_dict(data, HypervisorGroupResource.from_dict)
