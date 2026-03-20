from ..conftest import mock_client


class TestSelfServiceBuilder:
    def test_add_credit(self) -> None:
        vf, log = mock_client((200, {"data": {"id": 99}}))
        result = vf.self_service().add_credit("100", 50.0, reference_1=1)
        assert result["id"] == 99
        assert log.last.json["tokens"] == 50.0
        assert log.last.json["reference_1"] == 1
        assert log.last.method == "POST"

    def test_delete_credit(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().delete_credit(99)
        assert log.last.method == "DELETE"
        assert "/credit/99" in log.last.path

    def test_currencies(self) -> None:
        vf, log = mock_client((200, {"data": [{"code": "USD"}, {"code": "EUR"}]}))
        result = vf.self_service().currencies()
        assert len(result) == 2

    def test_sync_access(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().sync_access("100", sync_to_profiles=True)
        assert log.last.method == "PUT"
        assert log.last.json["syncToProfiles"] is True

    def test_add_hourly_group_profile(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().add_hourly_group_profile("100", 5)
        assert log.last.json["profileId"] == 5

    def test_remove_hourly_group_profile(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().remove_hourly_group_profile(5, "100")
        assert log.last.method == "DELETE"
        assert "/hourlyGroupProfile/5/" in log.last.path

    def test_add_resource_group_profile(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().add_resource_group_profile("100", 7)
        assert log.last.json["profileId"] == 7

    def test_remove_resource_group_profile(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().remove_resource_group_profile(7, "100")
        assert log.last.method == "DELETE"

    def test_create_resource_pack(self) -> None:
        vf, log = mock_client((200, {"data": {"id": 10}}))
        result = vf.self_service().create_resource_pack("100", 3)
        assert result["id"] == 10
        assert log.last.json["packId"] == 3

    def test_get_resource_pack(self) -> None:
        vf, log = mock_client((200, {"data": {"id": 10, "enabled": True}}))
        result = vf.self_service().get_resource_pack(10, with_servers=True)
        assert result["id"] == 10
        assert "withServers=true" in log.last.url

    def test_update_resource_pack(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().update_resource_pack(10, enabled=False)
        assert log.last.method == "PUT"
        assert log.last.json["enabled"] is False

    def test_delete_resource_pack(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().delete_resource_pack(10, disable=True)
        assert log.last.method == "DELETE"
        assert "disable=true" in log.last.url

    def test_suspend_resource_pack_servers(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().suspend_resource_pack_servers(10)
        assert "/suspend" in log.last.path

    def test_unsuspend_resource_pack_servers(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().unsuspend_resource_pack_servers(10)
        assert "/unsuspend" in log.last.path

    def test_delete_resource_pack_servers(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().delete_resource_pack_servers(10, delay=60)
        assert log.last.method == "DELETE"
        assert "delay=60" in log.last.url

    def test_set_hourly_resource_pack(self) -> None:
        vf, log = mock_client((200, {}))
        vf.self_service().set_hourly_resource_pack("100", 8)
        assert log.last.method == "PUT"
        assert log.last.json["packId"] == 8

    def test_hourly_stats(self) -> None:
        vf, log = mock_client((200, {"data": {"hours": []}}))
        result = vf.self_service().hourly_stats("100")
        assert "hours" in result

    def test_report(self) -> None:
        vf, log = mock_client((200, {"data": {"total": 100}}))
        result = vf.self_service().report("100", {"period": "monthly"})
        assert result["total"] == 100

    def test_usage(self) -> None:
        vf, log = mock_client((200, {"data": {"cpu": 50}}))
        result = vf.self_service().usage("100")
        assert result["cpu"] == 50
