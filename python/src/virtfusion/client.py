from __future__ import annotations

from typing import Any

from ._http import HttpClient
from .builders.backups import BackupsBuilder
from .builders.dns import DnsBuilder
from .builders.hypervisor_groups import HypervisorGroupsBuilder
from .builders.hypervisors import HypervisorsBuilder
from .builders.ip_blocks import IpBlocksBuilder
from .builders.media import MediaBuilder
from .builders.packages import PackagesBuilder
from .builders.queue import QueueBuilder
from .builders.self_service import SelfServiceBuilder
from .builders.server import ServerBuilder
from .builders.ssh_keys import SshKeysBuilder
from .builders.users import UsersBuilder
from .models.connection_test_result import ConnectionTestResult
from .models.server import Server
from .models.server_created import ServerCreated


class VirtFusion:
    def __init__(
        self,
        base_url: str,
        api_token: str,
        *,
        http: HttpClient | None = None,
    ) -> None:
        self._http = http or HttpClient(base_url, api_token)

    def __enter__(self) -> VirtFusion:
        return self

    def __exit__(self, *args: object) -> None:
        self.close()

    def close(self) -> None:
        self._http.close()

    def test_connection(self) -> ConnectionTestResult:
        data = self._http.request("GET", "connect")
        return ConnectionTestResult.from_dict(data)

    # --- Servers ---

    def server(self, server_id: int) -> ServerBuilder:
        return ServerBuilder(self._http, server_id)

    def create_server(self, params: dict[str, Any]) -> ServerCreated:
        data = self._http.request("POST", "servers", json=params)
        return ServerCreated.from_dict(data.get("data", data))

    def list_servers(self) -> list[Server]:
        data = self._http.request("GET", "servers")
        return [Server.from_dict(s) for s in data.get("data", [])]

    def list_servers_by_user(self, user_id: int) -> list[Server]:
        data = self._http.request("GET", f"servers/user/{user_id}")
        return [Server.from_dict(s) for s in data.get("data", [])]

    # --- Hypervisors ---

    def hypervisors(self) -> HypervisorsBuilder:
        return HypervisorsBuilder(self._http)

    def hypervisor_groups(self) -> HypervisorGroupsBuilder:
        return HypervisorGroupsBuilder(self._http)

    # --- Packages ---

    def packages(self) -> PackagesBuilder:
        return PackagesBuilder(self._http)

    # --- Users ---

    def users(self) -> UsersBuilder:
        return UsersBuilder(self._http)

    # --- SSH Keys ---

    def ssh_keys(self) -> SshKeysBuilder:
        return SshKeysBuilder(self._http)

    # --- IP Blocks ---

    def ip_blocks(self) -> IpBlocksBuilder:
        return IpBlocksBuilder(self._http)

    # --- Backups ---

    def backups(self) -> BackupsBuilder:
        return BackupsBuilder(self._http)

    # --- DNS ---

    def dns(self) -> DnsBuilder:
        return DnsBuilder(self._http)

    # --- Media ---

    def media(self) -> MediaBuilder:
        return MediaBuilder(self._http)

    # --- Queue ---

    def queue(self) -> QueueBuilder:
        return QueueBuilder(self._http)

    # --- Self Service ---

    def self_service(self) -> SelfServiceBuilder:
        return SelfServiceBuilder(self._http)
