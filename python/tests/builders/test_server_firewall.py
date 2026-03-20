import pytest

from virtfusion.builders.server_firewall import ServerFirewallBuilder
from virtfusion.models.firewall_config import FirewallConfig
from virtfusion.models.action_result import ActionResult

from ..conftest import load_fixture, mock_client


class TestServerFirewallBuilder:
    def test_get(self) -> None:
        vf, log = mock_client((200, load_fixture("firewall-config.json")))
        config = vf.server(69).firewall("primary").get()
        assert isinstance(config, FirewallConfig)
        assert config.enabled is True
        assert config.interface == "primary"
        assert len(config.rules) == 2
        assert config.rules[0].action == "accept"
        assert config.rules[0].port == "22"
        assert "/firewall/primary" in log.last.path

    def test_enable(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).firewall("primary").enable()
        assert isinstance(result, ActionResult)
        assert result.success is True
        assert "/enable" in log.last.path

    def test_disable(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).firewall("primary").disable()
        assert result.success is True
        assert "/disable" in log.last.path

    def test_apply_rules(self) -> None:
        vf, log = mock_client((200, load_fixture("action-success.json")))
        result = vf.server(69).firewall("primary").apply_rules([1, 2, 3])
        assert result.success is True
        assert log.last.json["rules"] == [1, 2, 3]

    def test_invalid_interface_raises(self) -> None:
        vf, _ = mock_client()
        with pytest.raises(ValueError, match="Invalid interface"):
            vf.server(69).firewall("bad;name")
