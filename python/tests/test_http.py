import httpx
import pytest

from virtfusion._http import HttpClient
from virtfusion.exceptions import (
    AuthenticationError,
    AuthorizationError,
    NotFoundError,
    RateLimitError,
    ServerError,
    ValidationError,
    VirtFusionError,
)

from .conftest import load_fixture


def _make_client(
    status: int,
    body: dict | None = None,
    headers: dict[str, str] | None = None,
) -> HttpClient:
    def handler(request: httpx.Request) -> httpx.Response:
        return httpx.Response(status, json=body or {}, headers=headers or {})

    transport = httpx.MockTransport(handler)
    client = httpx.Client(transport=transport, base_url="https://cp.test.com/api/v1/")
    http = HttpClient.__new__(HttpClient)
    http._client = client
    return http


class TestHttpClientRequest:
    def test_successful_get(self) -> None:
        fixture = load_fixture("connect.json")
        http = _make_client(200, fixture)
        result = http.request("GET", "connect")
        assert result["success"] is True

    def test_empty_body_returns_empty_dict(self) -> None:
        def handler(request: httpx.Request) -> httpx.Response:
            return httpx.Response(204)

        transport = httpx.MockTransport(handler)
        client = httpx.Client(transport=transport, base_url="https://cp.test.com/api/v1/")
        http = HttpClient.__new__(HttpClient)
        http._client = client
        assert http.request("DELETE", "some/resource") == {}


class TestHttpClientErrorMapping:
    def test_401_raises_authentication_error(self) -> None:
        http = _make_client(401, load_fixture("error-401.json"))
        with pytest.raises(AuthenticationError, match="Unauthenticated"):
            http.request("GET", "connect")

    def test_403_raises_authorization_error(self) -> None:
        http = _make_client(403, load_fixture("error-403.json"))
        with pytest.raises(AuthorizationError, match="Forbidden"):
            http.request("GET", "connect")

    def test_404_raises_not_found_error(self) -> None:
        http = _make_client(404, load_fixture("error-404.json"))
        with pytest.raises(NotFoundError, match="Not found"):
            http.request("GET", "servers/999")

    def test_422_raises_validation_error_with_errors(self) -> None:
        http = _make_client(422, load_fixture("error-422.json"))
        with pytest.raises(ValidationError) as exc_info:
            http.request("POST", "servers")
        assert "name" in exc_info.value.errors

    def test_429_raises_rate_limit_error_with_retry_after(self) -> None:
        http = _make_client(
            429,
            {"message": "Too many requests"},
            {"Retry-After": "60"},
        )
        with pytest.raises(RateLimitError) as exc_info:
            http.request("GET", "servers")
        assert exc_info.value.retry_after == 60

    def test_429_without_retry_after_header(self) -> None:
        http = _make_client(429, {"message": "Too many requests"})
        with pytest.raises(RateLimitError) as exc_info:
            http.request("GET", "servers")
        assert exc_info.value.retry_after is None

    def test_500_raises_server_error(self) -> None:
        http = _make_client(500, load_fixture("error-500.json"))
        with pytest.raises(ServerError, match="Internal server error"):
            http.request("GET", "connect")

    def test_connect_error_raises_virtfusion_error(self) -> None:
        def handler(request: httpx.Request) -> httpx.Response:
            raise httpx.ConnectError("connection refused")

        transport = httpx.MockTransport(handler)
        client = httpx.Client(transport=transport, base_url="https://cp.test.com/api/v1/")
        http = HttpClient.__new__(HttpClient)
        http._client = client
        with pytest.raises(VirtFusionError, match="Failed to connect"):
            http.request("GET", "connect")
