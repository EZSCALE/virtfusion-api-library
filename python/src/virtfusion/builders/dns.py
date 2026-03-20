from __future__ import annotations

from typing import Any

from .._helpers import unwrap_data
from .._http import HttpClient


class DnsBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def get_service(self, service_id: int) -> dict[str, Any]:
        data = self._http.request("GET", f"dns/services/{service_id}")
        return unwrap_data(data)
