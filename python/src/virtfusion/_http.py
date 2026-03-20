from __future__ import annotations

from typing import Any

import httpx

from .exceptions import (
    AuthenticationError,
    AuthorizationError,
    NotFoundError,
    RateLimitError,
    ServerError,
    ValidationError,
    VirtFusionError,
)


class HttpClient:
    def __init__(
        self,
        base_url: str,
        api_token: str,
        *,
        client: httpx.Client | None = None,
    ) -> None:
        self._client = client or httpx.Client(
            base_url=base_url.rstrip("/") + "/api/v1/",
            headers={
                "Authorization": f"Bearer {api_token}",
                "Accept": "application/json",
                "Content-Type": "application/json",
            },
        )

    def request(
        self,
        method: str,
        path: str,
        *,
        json: Any = None,
        params: dict[str, Any] | None = None,
    ) -> dict[str, Any]:
        try:
            response = self._client.request(
                method,
                path,
                json=json,
                params=params,
            )
        except httpx.ConnectError as exc:
            raise VirtFusionError(
                f"Failed to connect to VirtFusion API: {exc}"
            ) from exc

        if response.status_code >= 400:
            self._raise_for_status(response)

        if not response.content:
            return {}

        try:
            data: dict[str, Any] = response.json()
        except ValueError as exc:
            raise VirtFusionError(
                f"Failed to decode API response: {exc}"
            ) from exc

        return data

    def close(self) -> None:
        self._client.close()

    @staticmethod
    def _raise_for_status(response: httpx.Response) -> None:
        try:
            body: dict[str, Any] = response.json()
        except ValueError:
            body = {}

        message = body.get("message") or body.get("error") or response.reason_phrase or "Unknown error"
        status = response.status_code

        match status:
            case 401:
                raise AuthenticationError(message)
            case 403:
                raise AuthorizationError(message)
            case 404:
                raise NotFoundError(message)
            case 422:
                raise ValidationError(message, body.get("errors"))
            case 429:
                retry = response.headers.get("Retry-After")
                raise RateLimitError(message, int(retry) if retry else None)
            case s if s >= 500:
                raise ServerError(message)
            case _:
                raise VirtFusionError(message)
