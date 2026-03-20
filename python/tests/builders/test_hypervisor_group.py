from virtfusion.models.hypervisor_group import HypervisorGroup
from virtfusion.models.hypervisor_group_resource import HypervisorGroupResource
from virtfusion.models.paginated_response import PaginatedResponse

from ..conftest import load_fixture, mock_client


class TestHypervisorGroupBuilder:
    def test_get(self) -> None:
        vf, log = mock_client((200, load_fixture("hypervisor-group.json")))
        group = vf.hypervisor_groups().group(3).get()
        assert isinstance(group, HypervisorGroup)
        assert group.id == 3
        assert group.name == "AP South"
        assert group.description == "Asia Pacific cluster"

    def test_resources(self) -> None:
        vf, log = mock_client((200, load_fixture("hypervisor-group-resources.json")))
        result = vf.hypervisor_groups().group(1).resources()
        assert isinstance(result, PaginatedResponse)
        assert len(result.items) == 2
        res = result.items[0]
        assert isinstance(res, HypervisorGroupResource)
        assert res.hypervisor_id == 10
        assert res.hypervisor_name == "hv-us-1"
        assert "servers" in res.resources
