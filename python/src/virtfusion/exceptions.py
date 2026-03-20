from __future__ import annotations


class VirtFusionError(Exception):
    pass


class AuthenticationError(VirtFusionError):
    pass


class AuthorizationError(VirtFusionError):
    pass


class NotFoundError(VirtFusionError):
    pass


class ValidationError(VirtFusionError):
    def __init__(self, message: str, errors: dict[str, list[str]] | None = None) -> None:
        super().__init__(message)
        self.errors: dict[str, list[str]] = errors or {}


class RateLimitError(VirtFusionError):
    def __init__(self, message: str, retry_after: int | None = None) -> None:
        super().__init__(message)
        self.retry_after = retry_after


class ServerError(VirtFusionError):
    pass
