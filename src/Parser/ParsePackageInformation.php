<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Parser;

use AsyncBot\Plugin\PackagistFinder\Collection\Maintainers;
use AsyncBot\Plugin\PackagistFinder\Collection\Versions;
use AsyncBot\Plugin\PackagistFinder\ValueObject\GitHubInformation;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Maintainer;
use AsyncBot\Plugin\PackagistFinder\ValueObject\NumberOfDownloads;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Package;
use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Version;

final class ParsePackageInformation
{
    public function parse(array $packageInformation): Package
    {
        return new Package(
            PackageName::fromString($packageInformation['package']['name']),
            $packageInformation['package']['description'],
            new \DateTimeImmutable($packageInformation['package']['time']),
            $this->parseMaintainers($packageInformation['package']['maintainers']),
            $this->parseVersions($packageInformation['package']['versions']),
            $packageInformation['package']['type'],
            $packageInformation['package']['repository'],
            $this->parseGitHubInformation($packageInformation['package']),
            $packageInformation['package']['language'],
            $packageInformation['package']['dependents'],
            $packageInformation['package']['suggesters'],
            $this->parseNumberOfDownloads($packageInformation['package']['downloads']),
            $packageInformation['package']['favers'],
        );
    }

    private function parseMaintainers(array $maintainers): Maintainers
    {
        return new Maintainers(...array_map(static function (array $maintainer) {
            return new Maintainer($maintainer['name'], $maintainer['avatar_url']);
        }, $maintainers));
    }

    private function parseVersions(array $versions): Versions
    {
        $parsedVersions = [];

        foreach ($versions as $version => $versionInfo) {
            $parsedVersions[] = new Version(
                $version,
                PackageName::fromString($versionInfo['name']),
                $versionInfo['description'],
            );
        }

        return new Versions(...$parsedVersions);
    }

    private function parseNumberOfDownloads(array $downloads): NumberOfDownloads
    {
        return new NumberOfDownloads($downloads['total'], $downloads['monthly'], $downloads['daily']);
    }

    private function parseGitHubInformation(array $packageInformation): GitHubInformation
    {
        return new GitHubInformation(
            $packageInformation['github_stars'],
            $packageInformation['github_watchers'],
            $packageInformation['github_forks'],
            $packageInformation['github_open_issues'],
        );
    }
}
