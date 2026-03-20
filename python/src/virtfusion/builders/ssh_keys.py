from __future__ import annotations

from .._http import HttpClient
from ..models.ssh_key import SshKey


class SshKeysBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def create(self, user_id: int, name: str, public_key: str) -> SshKey:
        data = self._http.request(
            "POST",
            "ssh_keys",
            json={"userId": user_id, "name": name, "publicKey": public_key},
        )
        return SshKey.from_dict(data.get("data", data))

    def get(self, key_id: int) -> SshKey:
        data = self._http.request("GET", f"ssh_keys/{key_id}")
        return SshKey.from_dict(data.get("data", data))

    def list_by_user(self, user_id: int) -> list[SshKey]:
        data = self._http.request("GET", f"ssh_keys/user/{user_id}")
        return [SshKey.from_dict(k) for k in data.get("data", [])]

    def delete(self, key_id: int) -> None:
        self._http.request("DELETE", f"ssh_keys/{key_id}")
