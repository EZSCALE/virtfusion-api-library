from __future__ import annotations

from typing import Any

from .._helpers import unwrap_data
from .._http import HttpClient


class QueueBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def get(self, queue_id: int) -> dict[str, Any]:
        data = self._http.request("GET", f"queue/{queue_id}")
        return unwrap_data(data)
