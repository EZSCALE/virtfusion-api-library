from __future__ import annotations

import json
from dataclasses import dataclass, field
from pathlib import Path
from typing import Any

import httpx

FIXTURES_DIR = Path(__file__).parent / "fixtures"


@dataclass
class RequestRecord:
    method: str
    url: str
    content: bytes
    headers: httpx.Headers

    @property
    def json(self) -> Any:
        if not self.content:
            return None
        return json.loads(self.content)

    @property
    def path(self) -> str:
        return httpx.URL(self.url).path


@dataclass
class RequestLog:
    records: list[RequestRecord] = field(default_factory=list)

    @property
    def last(self) -> RequestRecord:
        return self.records[-1]

    def __len__(self) -> int:
        return len(self.records)


def load_fixture(name: str) -> dict[str, Any]:
    path = FIXTURES_DIR / name
    return json.loads(path.read_text())  # type: ignore[no-any-return]


def mock_client(
    *responses: tuple[int, dict[str, Any]]
    | tuple[int, dict[str, Any], dict[str, str]],
) -> tuple[Any, RequestLog]:
    from virtfusion.client import VirtFusion
    from virtfusion._http import HttpClient

    log = RequestLog()
    queue = list(responses)

    def handler(request: httpx.Request) -> httpx.Response:
        log.records.append(
            RequestRecord(
                method=request.method,
                url=str(request.url),
                content=request.content,
                headers=request.headers,
            )
        )
        if not queue:
            return httpx.Response(500, json={"message": "No responses queued"})
        item = queue.pop(0)
        status, body = item[0], item[1]
        headers = item[2] if len(item) > 2 else {}  # type: ignore[arg-type]
        return httpx.Response(status, json=body, headers=headers)  # type: ignore[arg-type]

    transport = httpx.MockTransport(handler)
    client = httpx.Client(
        transport=transport,
        base_url="https://cp.test.com/api/v1/",
    )
    http = HttpClient.__new__(HttpClient)
    http._client = client
    vf = VirtFusion("https://cp.test.com", "test-token", http=http)
    return vf, log
