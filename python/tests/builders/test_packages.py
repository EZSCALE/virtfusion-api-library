from virtfusion.models.package import Package

from ..conftest import load_fixture, mock_client


class TestPackagesBuilder:
    def test_list(self) -> None:
        vf, log = mock_client((200, load_fixture("packages.json")))
        packages = vf.packages().list()
        assert len(packages) == 2
        assert all(isinstance(p, Package) for p in packages)
        assert packages[0].name == "Starter"
        assert packages[1].name == "Pro"
        assert packages[0].memory == 1024
        assert packages[0].cpu_cores == 1

    def test_get(self) -> None:
        vf, log = mock_client((200, load_fixture("package.json")))
        pkg = vf.packages().get(1)
        assert isinstance(pkg, Package)
        assert pkg.id == 1
        assert pkg.primary_storage == 20
        assert pkg.traffic == 1000
