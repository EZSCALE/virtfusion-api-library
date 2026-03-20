from virtfusion.models.action_result import ActionResult
from virtfusion.models.server import Server
from virtfusion.builders.server_firewall import ServerFirewallBuilder
from virtfusion.builders.server_traffic_blocks import ServerTrafficBlocksBuilder

from ..conftest import load_fixture, mock_client


class TestServerBuilder:
    def test_get(self) -> None:
        vf, log = mock_client((200, load_fixture("server.json")))
        server = vf.server(69).get()
        assert isinstance(server, Server)
        assert server.id == 69
        assert server.name == "web1"
        assert server.hostname == "web1.example.com"
        assert server.state == "running"
        assert server.package_id == 5
        assert server.primary_ip == "10.0.0.1"
        assert log.last.path == "/api/v1/servers/69"

    def test_boot(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).boot()
        assert isinstance(result, ActionResult)
        assert result.success is True
        assert log.last.method == "POST"
        assert "/power/boot" in log.last.path

    def test_shutdown(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).shutdown()
        assert result.success is True
        assert "/power/shutdown" in log.last.path

    def test_restart(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).restart()
        assert result.success is True
        assert "/power/restart" in log.last.path

    def test_power_off(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).power_off()
        assert result.success is True
        assert "/power/poweroff" in log.last.path

    def test_delete(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).delete(delay=5)
        assert result.success is True
        assert log.last.method == "DELETE"
        assert "delay=5" in log.last.url

    def test_build(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).build({"templateId": 1})
        assert result.success is True
        assert log.last.json["templateId"] == 1

    def test_suspend(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).suspend()
        assert result.success is True
        assert "/suspend" in log.last.path

    def test_unsuspend(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).unsuspend()
        assert result.success is True
        assert "/unsuspend" in log.last.path

    def test_change_package(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).change_package(10)
        assert result.success is True
        assert "/package/10" in log.last.path

    def test_modify_backup_plan(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).modify_backup_plan(3)
        assert result.success is True
        assert "/backups/plan/3" in log.last.path

    def test_modify_name(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).modify_name("new-name")
        assert result.success is True
        assert log.last.json["name"] == "new-name"

    def test_modify_cpu_cores(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).modify_cpu_cores(4)
        assert result.success is True
        assert log.last.json["cores"] == 4

    def test_modify_cpu_throttle(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).modify_cpu_throttle(50, sync=True)
        assert result.success is True
        assert "sync=true" in log.last.url

    def test_modify_memory(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).modify_memory(2048)
        assert result.success is True
        assert log.last.json["memory"] == 2048

    def test_modify_traffic(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).modify_traffic({"limit": 1000})
        assert result.success is True
        assert log.last.json["limit"] == 1000

    def test_change_owner(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).change_owner(2)
        assert result.success is True
        assert "/owner/2" in log.last.path

    def test_reset_password(self) -> None:
        vf, log = mock_client((200, load_fixture("reset-password.json")))
        result = vf.server(69).reset_password()
        assert result["queueId"] == 42
        assert result["expectedPassword"] == "newpass123"

    def test_custom_xml(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).custom_xml({"xml": "<test/>"})
        assert result.success is True

    def test_add_to_whitelist(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).add_to_whitelist({"ip": "1.2.3.4"})
        assert result.success is True

    def test_remove_from_whitelist(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).remove_from_whitelist({"ip": "1.2.3.4"})
        assert result.success is True
        assert log.last.method == "DELETE"

    def test_add_ipv4(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).add_ipv4({"ip": "10.0.0.5"})
        assert result.success is True

    def test_add_ipv4_quantity(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).add_ipv4_quantity({"quantity": 2})
        assert result.success is True
        assert "/ipv4Qty" in log.last.path

    def test_remove_ipv4(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).remove_ipv4({"ip": "10.0.0.5"})
        assert result.success is True
        assert log.last.method == "DELETE"

    def test_traffic(self) -> None:
        vf, log = mock_client((200, load_fixture("traffic-stats.json")))
        result = vf.server(69).traffic()
        assert "monthly" in result

    def test_templates(self) -> None:
        vf, log = mock_client((200, {"data": [{"id": 1, "name": "Ubuntu"}]}))
        result = vf.server(69).templates()
        assert len(result) == 1

    def test_vnc(self) -> None:
        vf, log = mock_client((200, load_fixture("vnc.json")))
        result = vf.server(69).vnc()
        assert "vnc" in result

    def test_enable_vnc(self) -> None:
        vf, log = mock_client((200, load_fixture("vnc.json")))
        result = vf.server(69).enable_vnc()
        assert log.last.json["action"] == "enable"

    def test_disable_vnc(self) -> None:
        vf, log = mock_client((200, load_fixture("vnc.json")))
        result = vf.server(69).disable_vnc()
        assert log.last.json["action"] == "disable"

    def test_firewall_returns_sub_builder(self) -> None:
        vf, _ = mock_client()
        fb = vf.server(69).firewall("primary")
        assert isinstance(fb, ServerFirewallBuilder)

    def test_traffic_blocks_returns_sub_builder(self) -> None:
        vf, _ = mock_client()
        tb = vf.server(69).traffic_blocks()
        assert isinstance(tb, ServerTrafficBlocksBuilder)
