from __future__ import annotations

from typing import Any

from .._helpers import unwrap_data, unwrap_list
from .._http import HttpClient


class SelfServiceBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    # --- Credit ---

    def add_credit(
        self,
        ext_relation_id: str,
        tokens: float,
        *,
        reference_1: int | None = None,
        reference_2: str | None = None,
        rel_str: bool = False,
    ) -> dict[str, Any]:
        body: dict[str, Any] = {"tokens": tokens}
        if reference_1 is not None:
            body["reference_1"] = reference_1
        if reference_2 is not None:
            body["reference_2"] = reference_2

        data = self._http.request(
            "POST",
            f"selfService/credit/byUserExtRelationId/{ext_relation_id}",
            params={"relStr": "true" if rel_str else "false"},
            json=body,
        )
        return unwrap_data(data)

    def delete_credit(self, credit_id: int) -> None:
        self._http.request("DELETE", f"selfService/credit/{credit_id}")

    # --- Currencies ---

    def currencies(self) -> list[Any]:
        data = self._http.request("GET", "selfService/currencies")
        return unwrap_list(data)

    # --- Access ---

    def sync_access(
        self,
        ext_relation_id: str,
        *,
        sync_to_profiles: bool = False,
        rel_str: bool = False,
    ) -> None:
        self._http.request(
            "PUT",
            f"selfService/access/byUserExtRelationId/{ext_relation_id}",
            params={"relStr": "true" if rel_str else "false"},
            json={"syncToProfiles": sync_to_profiles},
        )

    # --- Hourly Group Profiles ---

    def add_hourly_group_profile(
        self,
        ext_relation_id: str,
        profile_id: int,
        *,
        rel_str: bool = False,
    ) -> None:
        self._http.request(
            "POST",
            f"selfService/hourlyGroupProfile/byUserExtRelationId/{ext_relation_id}",
            params={"relStr": "true" if rel_str else "false"},
            json={"profileId": profile_id},
        )

    def remove_hourly_group_profile(
        self,
        profile_id: int,
        ext_relation_id: str,
        *,
        rel_str: bool = False,
    ) -> None:
        self._http.request(
            "DELETE",
            f"selfService/hourlyGroupProfile/{profile_id}/byUserExtRelationId/{ext_relation_id}",
            params={"relStr": "true" if rel_str else "false"},
        )

    # --- Resource Group Profiles ---

    def add_resource_group_profile(
        self,
        ext_relation_id: str,
        profile_id: int,
        *,
        rel_str: bool = False,
    ) -> None:
        self._http.request(
            "POST",
            f"selfService/resourceGroupProfile/byUserExtRelationId/{ext_relation_id}",
            params={"relStr": "true" if rel_str else "false"},
            json={"profileId": profile_id},
        )

    def remove_resource_group_profile(
        self,
        profile_id: int,
        ext_relation_id: str,
        *,
        rel_str: bool = False,
    ) -> None:
        self._http.request(
            "DELETE",
            f"selfService/resourceGroupProfile/{profile_id}/byUserExtRelationId/{ext_relation_id}",
            params={"relStr": "true" if rel_str else "false"},
        )

    # --- Resource Packs ---

    def create_resource_pack(
        self,
        ext_relation_id: str,
        pack_id: int,
        *,
        enabled: bool = True,
        rel_str: bool = False,
    ) -> dict[str, Any]:
        data = self._http.request(
            "POST",
            f"selfService/resourcePack/byUserExtRelationId/{ext_relation_id}",
            params={"relStr": "true" if rel_str else "false"},
            json={"packId": pack_id, "enabled": enabled},
        )
        return unwrap_data(data)

    def get_resource_pack(
        self, pack_id: int, *, with_servers: bool = False
    ) -> dict[str, Any]:
        data = self._http.request(
            "GET",
            f"selfService/resourcePack/{pack_id}",
            params={"withServers": "true" if with_servers else "false"},
        )
        return unwrap_data(data)

    def update_resource_pack(self, pack_id: int, *, enabled: bool) -> None:
        self._http.request(
            "PUT",
            f"selfService/resourcePack/{pack_id}",
            json={"enabled": enabled},
        )

    def delete_resource_pack(
        self, pack_id: int, *, disable: bool = False
    ) -> None:
        self._http.request(
            "DELETE",
            f"selfService/resourcePack/{pack_id}",
            params={"disable": "true" if disable else "false"},
        )

    # --- Resource Pack Servers ---

    def suspend_resource_pack_servers(self, pack_id: int) -> None:
        self._http.request(
            "POST", f"selfService/resourcePackServers/{pack_id}/suspend"
        )

    def unsuspend_resource_pack_servers(self, pack_id: int) -> None:
        self._http.request(
            "POST", f"selfService/resourcePackServers/{pack_id}/unsuspend"
        )

    def delete_resource_pack_servers(
        self, pack_id: int, *, delay: int = 30
    ) -> None:
        self._http.request(
            "DELETE",
            f"selfService/resourcePackServers/{pack_id}",
            params={"delay": delay},
        )

    # --- Hourly Resource Pack ---

    def set_hourly_resource_pack(
        self,
        ext_relation_id: str,
        pack_id: int,
        *,
        rel_str: bool = False,
    ) -> None:
        self._http.request(
            "PUT",
            f"selfService/hourlyResourcePack/byUserExtRelationId/{ext_relation_id}",
            params={"relStr": "true" if rel_str else "false"},
            json={"packId": pack_id},
        )

    # --- Stats & Reports ---

    def hourly_stats(
        self,
        ext_relation_id: str,
        params: dict[str, Any] | None = None,
    ) -> dict[str, Any]:
        data = self._http.request(
            "GET",
            f"selfService/hourlyStats/byUserExtRelationId/{ext_relation_id}",
            params=params,
        )
        return unwrap_data(data)

    def report(
        self,
        ext_relation_id: str,
        params: dict[str, Any] | None = None,
    ) -> dict[str, Any]:
        data = self._http.request(
            "GET",
            f"selfService/report/byUserExtRelationId/{ext_relation_id}",
            params=params,
        )
        return unwrap_data(data)

    def usage(
        self,
        ext_relation_id: str,
        params: dict[str, Any] | None = None,
    ) -> dict[str, Any]:
        data = self._http.request(
            "GET",
            f"selfService/usage/byUserExtRelationId/{ext_relation_id}",
            params=params,
        )
        return unwrap_data(data)
