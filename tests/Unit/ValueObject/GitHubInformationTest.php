<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\ValueObject;

use AsyncBot\Plugin\PackagistFinder\ValueObject\GitHubInformation;
use PHPUnit\Framework\TestCase;

class GitHubInformationTest extends TestCase
{
    private GitHubInformation $gitHubInformation;

    protected function setUp(): void
    {
        $this->gitHubInformation = new GitHubInformation(1, 2, 3, 4);
    }

    public function testGetNumberOfStars(): void
    {
        $this->assertSame(1, $this->gitHubInformation->getNumberOfStars());
    }

    public function testGetNumberOfWatchers(): void
    {
        $this->assertSame(2, $this->gitHubInformation->getNumberOfWatchers());
    }

    public function testGetNumberOfForks(): void
    {
        $this->assertSame(3, $this->gitHubInformation->getNumberOfForks());
    }

    public function testGetNumberOfOpenIssues(): void
    {
        $this->assertSame(4, $this->gitHubInformation->getNumberOfOpenIssues());
    }
}
