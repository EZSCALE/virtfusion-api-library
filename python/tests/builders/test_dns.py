from ..conftest import mock_client


class TestDnsBuilder:
    def test_get_service(self) -> None:
        vf, log = mock_client((200, {"data": {"id": 5, "name": "dns-svc"}}))
        result = vf.dns().get_service(5)
        assert result["id"] == 5
        assert "/dns/services/5" in log.last.path
