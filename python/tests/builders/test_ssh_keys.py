from virtfusion.models.ssh_key import SshKey

from ..conftest import load_fixture, mock_client


class TestSshKeysBuilder:
    def test_create(self) -> None:
        vf, log = mock_client((200, load_fixture("ssh-key.json")))
        key = vf.ssh_keys().create(1, "my-key", "ssh-rsa AAAA...")
        assert isinstance(key, SshKey)
        assert key.id == 1
        assert key.name == "my-key"
        assert log.last.method == "POST"
        assert log.last.json["userId"] == 1

    def test_get(self) -> None:
        vf, log = mock_client((200, load_fixture("ssh-key.json")))
        key = vf.ssh_keys().get(1)
        assert isinstance(key, SshKey)
        assert key.type == "rsa"
        assert key.enabled is True

    def test_list_by_user(self) -> None:
        vf, log = mock_client((200, load_fixture("ssh-keys.json")))
        keys = vf.ssh_keys().list_by_user(1)
        assert len(keys) == 2
        assert all(isinstance(k, SshKey) for k in keys)
        assert keys[1].type == "ed25519"

    def test_delete(self) -> None:
        vf, log = mock_client((200, {}))
        vf.ssh_keys().delete(1)
        assert log.last.method == "DELETE"
        assert "/ssh_keys/1" in log.last.path
