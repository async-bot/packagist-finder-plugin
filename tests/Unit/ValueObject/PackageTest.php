<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\ValueObject;

use AsyncBot\Plugin\PackagistFinder\Collection\Maintainers;
use AsyncBot\Plugin\PackagistFinder\Collection\Versions;
use AsyncBot\Plugin\PackagistFinder\ValueObject\GitHubInformation;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Maintainer;
use AsyncBot\Plugin\PackagistFinder\ValueObject\NumberOfDownloads;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Package;
use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Version;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    private Package $package;

    protected function setUp(): void
    {
        $this->package = new Package(
            new PackageName('foo', 'bar'),
            'The description',
            new \DateTimeImmutable('2019-12-05 12:01:24'),
            new Maintainers(
                new Maintainer('Test Maintainer', 'https://example.com'),
            ),
            new Versions(
                new Version('dev-master', new PackageName('foo', 'bar1'), 'Description 1'),
                new Version('1.0.0', new PackageName('foo', 'bar2'), 'Description 2'),
            ),
            'library',
            'https://github.com/foo/bar',
            new GitHubInformation(1, 2, 3, 4),
            'PHP',
            13,
            21,
            new NumberOfDownloads(16, 5, 3),
            99,
        );
    }

    public function testGetPackageName(): void
    {
        $this->assertSame('foo', $this->package->getPackageName()->getVendor());
        $this->assertSame('bar', $this->package->getPackageName()->getPackage());
    }

    public function testGetDescription(): void
    {
        $this->assertSame('The description', $this->package->getDescription());
    }

    public function testGetCreatedAt(): void
    {
        $this->assertSame('2019-12-05 12:01:24', $this->package->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testGetVersions(): void
    {
        $this->assertCount(2, iterator_to_array($this->package->getVersions()));
    }

    public function testGetType(): void
    {
        $this->assertSame('library', $this->package->getType());
    }

    public function testGetRepositoryUrl(): void
    {
        $this->assertSame('https://github.com/foo/bar', $this->package->getRepositoryUrl());
    }

    public function testGetGitHubInformation(): void
    {
        $this->assertSame(1, $this->package->getGitHubInformation()->getNumberOfStars());
        $this->assertSame(2, $this->package->getGitHubInformation()->getNumberOfWatchers());
        $this->assertSame(3, $this->package->getGitHubInformation()->getNumberOfForks());
        $this->assertSame(4, $this->package->getGitHubInformation()->getNumberOfOpenIssues());
    }

    public function testGetLanguage(): void
    {
        $this->assertSame('PHP', $this->package->getLanguage());
    }

    public function testGetNumberOfDependents(): void
    {
        $this->assertSame(13, $this->package->getNumberOfDependents());
    }

    public function testGetNumberOfSuggesters(): void
    {
        $this->assertSame(21, $this->package->getNumberOfSuggesters());
    }

    public function testGetNumberOfDownloads(): void
    {
        $this->assertSame(16, $this->package->getNumberOfDownloads()->getTotal());
        $this->assertSame(5, $this->package->getNumberOfDownloads()->getMonthly());
        $this->assertSame(3, $this->package->getNumberOfDownloads()->getDaily());
    }

    public function testGetNumberOfFavorites(): void
    {
        $this->assertSame(99, $this->package->getNumberOfFavorites());
    }
}
