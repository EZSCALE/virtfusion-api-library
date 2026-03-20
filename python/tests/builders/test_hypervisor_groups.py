from virtfusion.models.hypervisor_group import HypervisorGroup
from virtfusion.models.paginated_response import PaginatedResponse
from virtfusion.builders.hypervisor_group import HypervisorGroupBuilder

from ..conftest import load_fixture, mock_client


class TestHypervisorGroupsBuilder:
    def test_list(self) -> None:
        vf, log = mock_client((200, load_fixture("hypervisor-groups.json")))
        result = vf.hypervisor_groups().list()
        assert isinstance(result, PaginatedResponse)
        assert len(result.items) == 2
        assert result.total == 2
        group = result.items[0]
        assert isinstance(group, HypervisorGroup)
        assert group.id == 1
        assert group.name == "US East"

    def test_group_returns_builder(self) -> None:
        vf, _ = mock_client()
        builder = vf.hypervisor_groups().group(3)
        assert isinstance(builder, HypervisorGroupBuilder)
