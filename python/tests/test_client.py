from virtfusion.client import VirtFusion
from virtfusion.builders.server import ServerBuilder
from virtfusion.builders.hypervisors import HypervisorsBuilder
from virtfusion.builders.hypervisor_groups import HypervisorGroupsBuilder
from virtfusion.builders.packages import PackagesBuilder
from virtfusion.builders.users import UsersBuilder
from virtfusion.builders.ssh_keys import SshKeysBuilder
from virtfusion.builders.ip_blocks import IpBlocksBuilder
from virtfusion.builders.backups import BackupsBuilder
from virtfusion.builders.dns import DnsBuilder
from virtfusion.builders.media import MediaBuilder
from virtfusion.builders.queue import QueueBuilder
from virtfusion.builders.self_service import SelfServiceBuilder
from virtfusion.models.connection_test_result import ConnectionTestResult
from virtfusion.models.server import Server
from virtfusion.models.server_created import ServerCreated

from .conftest import load_fixture, mock_client


class TestVirtFusionClient:
    def test_test_connection(self) -> None:
        vf, log = mock_client((200, load_fixture("connect.json")))
        result = vf.test_connection()
        assert isinstance(result, ConnectionTestResult)
        assert result.success is True
        assert log.last.method == "GET"
        assert log.last.path == "/api/v1/connect"

    def test_create_server(self) -> None:
        vf, log = mock_client((200, load_fixture("server-created.json")))
        result = vf.create_server({"name": "web2", "packageId": 5})
        assert isinstance(result, ServerCreated)
        assert result.id == 70
        assert log.last.json["name"] == "web2"

    def test_list_servers(self) -> None:
        vf, log = mock_client((200, load_fixture("servers-list.json")))
        servers = vf.list_servers()
        assert len(servers) == 2
        assert all(isinstance(s, Server) for s in servers)
        assert servers[0].id == 69

    def test_list_servers_by_user(self) -> None:
        vf, log = mock_client((200, load_fixture("servers-list.json")))
        servers = vf.list_servers_by_user(1)
        assert len(servers) == 2
        assert "/api/v1/servers/user/1" in log.last.path

    def test_builder_factories_return_correct_types(self) -> None:
        vf, _ = mock_client()
        assert isinstance(vf.server(1), ServerBuilder)
        assert isinstance(vf.hypervisors(), HypervisorsBuilder)
        assert isinstance(vf.hypervisor_groups(), HypervisorGroupsBuilder)
        assert isinstance(vf.packages(), PackagesBuilder)
        assert isinstance(vf.users(), UsersBuilder)
        assert isinstance(vf.ssh_keys(), SshKeysBuilder)
        assert isinstance(vf.ip_blocks(), IpBlocksBuilder)
        assert isinstance(vf.backups(), BackupsBuilder)
        assert isinstance(vf.dns(), DnsBuilder)
        assert isinstance(vf.media(), MediaBuilder)
        assert isinstance(vf.queue(), QueueBuilder)
        assert isinstance(vf.self_service(), SelfServiceBuilder)

    def test_context_manager(self) -> None:
        vf, log = mock_client((200, load_fixture("connect.json")))
        with vf:
            result = vf.test_connection()
        assert result.success is True


class TestPublicApi:
    def test_import_from_package(self) -> None:
        from virtfusion import VirtFusion, __version__

        assert VirtFusion is not None
        assert isinstance(__version__, str)
