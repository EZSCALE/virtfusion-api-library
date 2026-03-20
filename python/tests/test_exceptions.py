from virtfusion.exceptions import (
    AuthenticationError,
    AuthorizationError,
    NotFoundError,
    RateLimitError,
    ServerError,
    ValidationError,
    VirtFusionError,
)


class TestExceptionHierarchy:
    def test_all_inherit_from_base(self) -> None:
        for cls in (
            AuthenticationError,
            AuthorizationError,
            NotFoundError,
            ValidationError,
            RateLimitError,
            ServerError,
        ):
            assert issubclass(cls, VirtFusionError)

    def test_validation_error_carries_errors(self) -> None:
        err = ValidationError("bad", {"name": ["required"]})
        assert str(err) == "bad"
        assert err.errors == {"name": ["required"]}

    def test_validation_error_defaults_empty(self) -> None:
        err = ValidationError("bad")
        assert err.errors == {}

    def test_rate_limit_error_carries_retry_after(self) -> None:
        err = RateLimitError("slow down", retry_after=30)
        assert err.retry_after == 30

    def test_rate_limit_error_retry_after_none(self) -> None:
        err = RateLimitError("slow down")
        assert err.retry_after is None
