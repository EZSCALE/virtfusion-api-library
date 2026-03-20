from __future__ import annotations

from typing import Any

from .._helpers import unwrap_data, unwrap_list
from .._http import HttpClient
from ..models.action_result import ActionResult
from ..models.server import Server


class ServerBuilder:
    def __init__(self, http: HttpClient, server_id: int) -> None:
        self._http = http
        self._server_id = server_id

    def get(self) -> Server:
        data = self._http.request("GET", f"servers/{self._server_id}")
        return Server.from_dict(unwrap_data(data))

    # --- Power ---

    def boot(self) -> ActionResult:
        data = self._http.request("POST", f"servers/{self._server_id}/power/boot")
        return ActionResult.from_dict(data)

    def shutdown(self) -> ActionResult:
        data = self._http.request("POST", f"servers/{self._server_id}/power/shutdown")
        return ActionResult.from_dict(data)

    def restart(self) -> ActionResult:
        data = self._http.request("POST", f"servers/{self._server_id}/power/restart")
        return ActionResult.from_dict(data)

    def power_off(self) -> ActionResult:
        data = self._http.request("POST", f"servers/{self._server_id}/power/poweroff")
        return ActionResult.from_dict(data)

    # --- Lifecycle ---

    def delete(self, delay: int = 0) -> ActionResult:
        data = self._http.request(
            "DELETE", f"servers/{self._server_id}", params={"delay": delay}
        )
        return ActionResult.from_dict(data)

    def build(self, params: dict[str, Any]) -> ActionResult:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/build", json=params
        )
        return ActionResult.from_dict(data)

    def suspend(self) -> ActionResult:
        data = self._http.request("POST", f"servers/{self._server_id}/suspend")
        return ActionResult.from_dict(data)

    def unsuspend(self) -> ActionResult:
        data = self._http.request("POST", f"servers/{self._server_id}/unsuspend")
        return ActionResult.from_dict(data)

    # --- Modification ---

    def change_package(self, package_id: int) -> ActionResult:
        data = self._http.request(
            "PUT", f"servers/{self._server_id}/package/{package_id}"
        )
        return ActionResult.from_dict(data)

    def modify_backup_plan(self, plan_id: int) -> ActionResult:
        data = self._http.request(
            "PUT", f"servers/{self._server_id}/backups/plan/{plan_id}"
        )
        return ActionResult.from_dict(data)

    def modify_name(self, name: str) -> ActionResult:
        data = self._http.request(
            "PUT", f"servers/{self._server_id}/modify/name", json={"name": name}
        )
        return ActionResult.from_dict(data)

    def modify_cpu_cores(self, cores: int) -> ActionResult:
        data = self._http.request(
            "PUT", f"servers/{self._server_id}/modify/cpuCores", json={"cores": cores}
        )
        return ActionResult.from_dict(data)

    def modify_cpu_throttle(self, percent: int, *, sync: bool = False) -> ActionResult:
        data = self._http.request(
            "PUT",
            f"servers/{self._server_id}/modify/cpuThrottle",
            params={"sync": "true" if sync else "false"},
            json={"percent": percent},
        )
        return ActionResult.from_dict(data)

    def modify_memory(self, memory_mb: int) -> ActionResult:
        data = self._http.request(
            "PUT",
            f"servers/{self._server_id}/modify/memory",
            json={"memory": memory_mb},
        )
        return ActionResult.from_dict(data)

    def modify_traffic(self, params: dict[str, Any]) -> ActionResult:
        data = self._http.request(
            "PUT", f"servers/{self._server_id}/modify/traffic", json=params
        )
        return ActionResult.from_dict(data)

    def change_owner(self, new_owner_id: int) -> ActionResult:
        data = self._http.request(
            "PUT", f"servers/{self._server_id}/owner/{new_owner_id}"
        )
        return ActionResult.from_dict(data)

    # --- Password ---

    def reset_password(
        self, user: str = "root", *, send_mail: bool = True
    ) -> dict[str, Any]:
        data = self._http.request(
            "POST",
            f"servers/{self._server_id}/resetPassword",
            json={"user": user, "sendMail": send_mail},
        )
        return unwrap_data(data)

    # --- Custom XML ---

    def custom_xml(self, params: dict[str, Any]) -> ActionResult:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/customXML", json=params
        )
        return ActionResult.from_dict(data)

    # --- Network ---

    def add_to_whitelist(self, params: dict[str, Any]) -> ActionResult:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/networkWhitelist", json=params
        )
        return ActionResult.from_dict(data)

    def remove_from_whitelist(self, params: dict[str, Any]) -> ActionResult:
        data = self._http.request(
            "DELETE", f"servers/{self._server_id}/networkWhitelist", json=params
        )
        return ActionResult.from_dict(data)

    def add_ipv4(self, params: dict[str, Any]) -> ActionResult:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/ipv4", json=params
        )
        return ActionResult.from_dict(data)

    def add_ipv4_quantity(self, params: dict[str, Any]) -> ActionResult:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/ipv4Qty", json=params
        )
        return ActionResult.from_dict(data)

    def remove_ipv4(self, params: dict[str, Any]) -> ActionResult:
        data = self._http.request(
            "DELETE", f"servers/{self._server_id}/ipv4", json=params
        )
        return ActionResult.from_dict(data)

    # --- Traffic ---

    def traffic(self) -> dict[str, Any]:
        data = self._http.request("GET", f"servers/{self._server_id}/traffic")
        return unwrap_data(data)

    # --- Templates ---

    def templates(self) -> list[Any]:
        data = self._http.request("GET", f"servers/{self._server_id}/templates")
        return unwrap_list(data)

    # --- VNC ---

    def vnc(self) -> dict[str, Any]:
        data = self._http.request("GET", f"servers/{self._server_id}/vnc")
        return unwrap_data(data)

    def enable_vnc(self) -> dict[str, Any]:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/vnc", json={"action": "enable"}
        )
        return unwrap_data(data)

    def disable_vnc(self) -> dict[str, Any]:
        data = self._http.request(
            "POST", f"servers/{self._server_id}/vnc", json={"action": "disable"}
        )
        return unwrap_data(data)

    # --- Sub-builders ---

    def firewall(self, interface: str) -> ServerFirewallBuilder:
        return ServerFirewallBuilder(self._http, self._server_id, interface)

    def traffic_blocks(self) -> ServerTrafficBlocksBuilder:
        return ServerTrafficBlocksBuilder(self._http, self._server_id)


# Avoid circular imports by importing at the bottom
from .server_firewall import ServerFirewallBuilder  # noqa: E402
from .server_traffic_blocks import ServerTrafficBlocksBuilder  # noqa: E402
