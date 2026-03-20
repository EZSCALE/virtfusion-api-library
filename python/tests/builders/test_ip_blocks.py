from virtfusion.models.action_result import ActionResult
from virtfusion.models.ip_block import IpBlock
from virtfusion.models.paginated_response import PaginatedResponse

from ..conftest import load_fixture, mock_client


class TestIpBlocksBuilder:
    def test_list(self) -> None:
        vf, log = mock_client((200, load_fixture("ip-blocks.json")))
        result = vf.ip_blocks().list()
        assert isinstance(result, PaginatedResponse)
        assert len(result.items) == 1
        block = result.items[0]
        assert isinstance(block, IpBlock)
        assert block.id == 1
        assert block.name == "Primary Block"
        assert block.enabled is True

    def test_get(self) -> None:
        vf, log = mock_client((200, load_fixture("ip-block.json")))
        block = vf.ip_blocks().get(1)
        assert isinstance(block, IpBlock)
        assert block.ipv4["gateway"] == "10.0.0.1"

    def test_add_ipv4_range(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.ip_blocks().add_ipv4_range(1, "10.0.0.10", "10.0.0.20")
        assert isinstance(result, ActionResult)
        assert result.success is True
        assert log.last.json["type"] == "range"
        assert log.last.json["start"] == "10.0.0.10"
