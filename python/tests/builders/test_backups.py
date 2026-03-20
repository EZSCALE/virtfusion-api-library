from virtfusion.models.backup import Backup

from ..conftest import load_fixture, mock_client


class TestBackupsBuilder:
    def test_list_by_server(self) -> None:
        vf, log = mock_client((200, load_fixture("backups.json")))
        backups = vf.backups().list_by_server(69)
        assert len(backups) == 2
        assert all(isinstance(b, Backup) for b in backups)
        assert backups[0].id == 1
        assert backups[0].server_id == 69
        assert backups[0].complete is True
        assert backups[1].complete is False
        assert "/backups/server/69" in log.last.path
