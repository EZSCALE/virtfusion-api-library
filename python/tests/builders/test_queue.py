from ..conftest import load_fixture, mock_client


class TestQueueBuilder:
    def test_get(self) -> None:
        vf, log = mock_client((200, load_fixture("queue.json")))
        result = vf.queue().get(42)
        assert result["id"] == 42
        assert result["job"] == "ServerBuild"
        assert result["progress"] == 75
        assert "/queue/42" in log.last.path
