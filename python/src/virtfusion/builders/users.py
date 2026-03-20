from __future__ import annotations

from typing import Any

from .._helpers import unwrap_data
from .._http import HttpClient
from ..models.user import User


class UsersBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def create(self, params: dict[str, Any]) -> User:
        data = self._http.request("POST", "users", json=params)
        return User.from_dict(unwrap_data(data))

    def get_by_ext_relation(
        self, ext_relation_id: str, *, rel_str: bool = False
    ) -> User:
        data = self._http.request(
            "GET",
            f"users/{ext_relation_id}/byExtRelation",
            params={"relStr": "true" if rel_str else "false"},
        )
        return User.from_dict(unwrap_data(data))

    def update_by_ext_relation(
        self,
        ext_relation_id: str,
        params: dict[str, Any],
        *,
        rel_str: bool = False,
    ) -> None:
        self._http.request(
            "PUT",
            f"users/{ext_relation_id}/byExtRelation",
            params={"relStr": "true" if rel_str else "false"},
            json=params,
        )

    def delete_by_ext_relation(
        self, ext_relation_id: str, *, rel_str: bool = False
    ) -> None:
        self._http.request(
            "DELETE",
            f"users/{ext_relation_id}/byExtRelation",
            params={"relStr": "true" if rel_str else "false"},
        )

    def reset_password_by_ext_relation(
        self, ext_relation_id: str, *, rel_str: bool = False
    ) -> dict[str, Any]:
        data = self._http.request(
            "POST",
            f"users/{ext_relation_id}/byExtRelation/resetPassword",
            params={"relStr": "true" if rel_str else "false"},
        )
        return unwrap_data(data)

    def authentication_tokens(
        self, ext_relation_id: str, *, rel_str: bool = False
    ) -> dict[str, Any]:
        data = self._http.request(
            "POST",
            f"users/{ext_relation_id}/authenticationTokens",
            params={"relStr": "true" if rel_str else "false"},
        )
        return unwrap_data(data)

    def server_authentication_tokens(
        self,
        ext_relation_id: str,
        server_id: int,
        *,
        rel_str: bool = False,
    ) -> dict[str, Any]:
        data = self._http.request(
            "POST",
            f"users/{ext_relation_id}/serverAuthenticationTokens/{server_id}",
            params={"relStr": "true" if rel_str else "false"},
        )
        return unwrap_data(data)
