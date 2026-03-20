from __future__ import annotations

from .._http import HttpClient
from ..models.package import Package


class PackagesBuilder:
    def __init__(self, http: HttpClient) -> None:
        self._http = http

    def list(self) -> list[Package]:
        data = self._http.request("GET", "packages")
        return [Package.from_dict(p) for p in data.get("data", [])]

    def get(self, package_id: int) -> Package:
        data = self._http.request("GET", f"packages/{package_id}")
        return Package.from_dict(data.get("data", data))
