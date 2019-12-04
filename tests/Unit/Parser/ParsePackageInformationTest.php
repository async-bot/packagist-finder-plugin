<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\Parser;

use AsyncBot\Plugin\PackagistFinder\Parser\ParsePackageInformation;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Package;
use PHPUnit\Framework\TestCase;
use function ExceptionalJSON\decode;

class ParsePackageInformationTest extends TestCase
{
    private Package $package;

    protected function setUp(): void
    {
        $this->package = (new ParsePackageInformation())
            ->parse(
                decode(file_get_contents(TEST_DATA_DIR . '/Response/get-monolog-monolog-package.json'), true),
            )
        ;
    }

    public function testPackageNameIsCorrectlyParsed(): void
    {
        $this->assertSame('monolog', $this->package->getPackageName()->getVendor());
        $this->assertSame('monolog', $this->package->getPackageName()->getPackage());
    }

    public function testDescriptionIsCorrectlyParsed(): void
    {
        $this->assertSame(
            'Sends your logs to files, sockets, inboxes, databases and various web services',
            $this->package->getDescription(),
        );
    }

    public function testCreatedAtIsCorrectlyParsed(): void
    {
        $this->assertSame(
            '2011-09-27 00:35:19',
            $this->package->getCreatedAt()->format('Y-m-d H:i:s'),
        );
    }

    public function testMaintainersAreCorrectlyParsed(): void
    {
        $maintainers = iterator_to_array($this->package->getMaintainers());

        $this->assertCount(1, $maintainers);

        $this->assertSame('Seldaek', $maintainers[0]->getName());
        $this->assertSame(
            'https://www.gravatar.com/avatar/48b79d17cd8a911327cbd88c122b1efb?d=identicon',
            $maintainers[0]->getAvatarUrl(),
        );
    }

    public function testVersionsAreCorrectlyParsed(): void
    {
        $versions = iterator_to_array($this->package->getVersions());

        $this->assertCount(47, $versions);

        $this->assertSame('dev-master', $versions[0]->getVersion());
        $this->assertSame('monolog', $versions[0]->getPackageName()->getVendor());
        $this->assertSame('monolog', $versions[0]->getPackageName()->getPackage());
        $this->assertSame(
            'Sends your logs to files, sockets, inboxes, databases and various web services',
            $versions[0]->getDescription(),
        );
    }

    public function testTypeIsCorrectlyParsed(): void
    {
        $this->assertSame('library', $this->package->getType());
    }

    public function testRepositoryIsCorrectlyParsed(): void
    {
        $this->assertSame(
            'https://github.com/Seldaek/monolog',
            $this->package->getRepositoryUrl(),
        );
    }

    public function testGitHubInformationIsCorrectlyParsed(): void
    {
        $gitHubInfo = $this->package->getGitHubInformation();

        $this->assertSame(16253, $gitHubInfo->getNumberOfStars());
        $this->assertSame(336, $gitHubInfo->getNumberOfWatchers());
        $this->assertSame(1590, $gitHubInfo->getNumberOfForks());
        $this->assertSame(39, $gitHubInfo->getNumberOfOpenIssues());
    }

    public function testLanguageIsCorrectlyParsed(): void
    {
        $this->assertSame('PHP', $this->package->getLanguage());
    }

    public function testNumberOfDependentsAreCorrectlyParsed(): void
    {
        $this->assertSame(4711, $this->package->getNumberOfDependents());
    }

    public function testNumberOfSuggestersAreCorrectlyParsed(): void
    {
        $this->assertSame(402, $this->package->getNumberOfSuggesters());
    }

    public function testDownloadsAreCorrectlyParsed(): void
    {
        $this->assertSame(173728393, $this->package->getNumberOfDownloads()->getTotal());
        $this->assertSame(5476515, $this->package->getNumberOfDownloads()->getMonthly());
        $this->assertSame(227326, $this->package->getNumberOfDownloads()->getDaily());
    }

    public function testNumberOfFavoritesIsCorrectlyParsed(): void
    {
        $this->assertSame(16793, $this->package->getNumberOfFavorites());
    }
}
