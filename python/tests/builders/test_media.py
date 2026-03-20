from ..conftest import mock_client


class TestMediaBuilder:
    def test_get_iso(self) -> None:
        vf, log = mock_client((200, {"data": {"id": 1, "name": "ubuntu.iso"}}))
        result = vf.media().get_iso(1)
        assert result["id"] == 1
        assert "/media/iso/1" in log.last.path

    def test_templates_from_package_spec(self) -> None:
        vf, log = mock_client((200, {"data": [{"id": 1}, {"id": 2}]}))
        result = vf.media().templates_from_package_spec(5)
        assert len(result) == 2
        assert "/fromServerPackageSpec/5" in log.last.path
