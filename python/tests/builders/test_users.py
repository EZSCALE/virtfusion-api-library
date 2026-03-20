from virtfusion.models.user import User

from ..conftest import load_fixture, mock_client


class TestUsersBuilder:
    def test_create(self) -> None:
        vf, log = mock_client((200, load_fixture("user.json")))
        user = vf.users().create({"name": "John Doe", "email": "john@example.com"})
        assert isinstance(user, User)
        assert user.id == 1
        assert user.name == "John Doe"
        assert user.email == "john@example.com"
        assert log.last.method == "POST"

    def test_get_by_ext_relation(self) -> None:
        vf, log = mock_client((200, load_fixture("user.json")))
        user = vf.users().get_by_ext_relation("100")
        assert isinstance(user, User)
        assert user.ext_relation_id == 100
        assert "/users/100/byExtRelation" in log.last.path

    def test_get_by_ext_relation_with_rel_str(self) -> None:
        vf, log = mock_client((200, load_fixture("user.json")))
        vf.users().get_by_ext_relation("abc", rel_str=True)
        assert "relStr=true" in log.last.url

    def test_update_by_ext_relation(self) -> None:
        vf, log = mock_client((200, {}))
        vf.users().update_by_ext_relation("100", {"name": "Jane"})
        assert log.last.method == "PUT"
        assert log.last.json["name"] == "Jane"

    def test_delete_by_ext_relation(self) -> None:
        vf, log = mock_client((200, {}))
        vf.users().delete_by_ext_relation("100")
        assert log.last.method == "DELETE"

    def test_reset_password_by_ext_relation(self) -> None:
        vf, log = mock_client((200, load_fixture("user-password-reset.json")))
        result = vf.users().reset_password_by_ext_relation("100")
        assert result["email"] == "john@example.com"
        assert result["password"] == "newpass456"

    def test_authentication_tokens(self) -> None:
        vf, log = mock_client((200, load_fixture("auth-tokens.json")))
        result = vf.users().authentication_tokens("100")
        assert "authentication" in result
        assert log.last.method == "POST"

    def test_server_authentication_tokens(self) -> None:
        vf, log = mock_client((200, load_fixture("auth-tokens.json")))
        result = vf.users().server_authentication_tokens("100", 69)
        assert "authentication" in result
        assert "/serverAuthenticationTokens/69" in log.last.path
