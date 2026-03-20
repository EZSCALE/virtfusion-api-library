from __future__ import annotations

from typing import Any

from .._helpers import unwrap_data, unwrap_list
from .._http import HttpClient


class MediaBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def get_iso(self, iso_id: int) -> dict[str, Any]:
        data = self._http.request("GET", f"media/iso/{iso_id}")
        return unwrap_data(data)

    def templates_from_package_spec(self, server_package_id: int) -> list[Any]:
        data = self._http.request(
            "GET", f"media/templates/fromServerPackageSpec/{server_package_id}"
        )
        return unwrap_list(data)
