from virtfusion.models.hypervisor import Hypervisor
from virtfusion.models.paginated_response import PaginatedResponse
from virtfusion.builders.hypervisor_groups import HypervisorGroupsBuilder

from ..conftest import load_fixture, mock_client


class TestHypervisorsBuilder:
    def test_list(self) -> None:
        vf, log = mock_client((200, load_fixture("hypervisors.json")))
        result = vf.hypervisors().list(results=10)
        assert isinstance(result, PaginatedResponse)
        assert len(result.items) == 1
        hv = result.items[0]
        assert isinstance(hv, Hypervisor)
        assert hv.id == 1
        assert hv.name == "hv-us-1"
        assert hv.enabled is True
        assert "results=10" in log.last.url

    def test_get(self) -> None:
        vf, log = mock_client((200, load_fixture("hypervisor.json")))
        hv = vf.hypervisors().get(1)
        assert isinstance(hv, Hypervisor)
        assert hv.id == 1
        assert hv.max_servers == 50
        assert hv.max_cpu == 128
        assert hv.max_memory == 262144

    def test_groups_returns_builder(self) -> None:
        vf, _ = mock_client()
        assert isinstance(vf.hypervisors().groups(), HypervisorGroupsBuilder)
