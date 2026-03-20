from __future__ import annotations

from .._http import HttpClient
from ..models.backup import Backup


class BackupsBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def list_by_server(self, server_id: int) -> list[Backup]:
        data = self._http.request("GET", f"backups/server/{server_id}")
        return [Backup.from_dict(b) for b in data.get("data", [])]
