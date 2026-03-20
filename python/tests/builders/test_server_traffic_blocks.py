from virtfusion.models.action_result import ActionResult
from virtfusion.models.traffic_block import TrafficBlock

from ..conftest import load_fixture, mock_client


class TestServerTrafficBlocksBuilder:
    def test_list(self) -> None:
        vf, log = mock_client((200, load_fixture("traffic-blocks.json")))
        blocks = vf.server(69).traffic_blocks().list()
        assert len(blocks) == 2
        assert all(isinstance(b, TrafficBlock) for b in blocks)
        assert blocks[0].id == 42
        assert blocks[0].ip == "1.2.3.4"
        assert blocks[0].reason == "Abuse"
        assert blocks[1].reason is None

    def test_add(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).traffic_blocks().add({"ip": "9.8.7.6"})
        assert isinstance(result, ActionResult)
        assert result.success is True
        assert log.last.method == "POST"

    def test_remove(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).traffic_blocks().remove(42)
        assert result.success is True
        assert log.last.method == "DELETE"
        assert "/traffic/blocks/42" in log.last.path
