<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\ValueObject;

use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\SearchResult;
use PHPUnit\Framework\TestCase;

class SearchResultTest extends TestCase
{
    private SearchResult $searchResult;

    protected function setUp(): void
    {
        $this->searchResult = new SearchResult(
            new PackageName('foo', 'bar'),
            'The description',
            'https://example.com',
            'https://github.com/foo/bar',
            1,
            2,
        );
    }

    public function testGetPackageName(): void
    {
        $this->assertSame('foo', $this->searchResult->getPackageName()->getVendor());
        $this->assertSame('bar', $this->searchResult->getPackageName()->getPackage());
    }

    public function testGetDescription(): void
    {
        $this->assertSame('The description', $this->searchResult->getDescription());
    }

    public function testGetUrl(): void
    {
        $this->assertSame('https://example.com', $this->searchResult->getUrl());
    }

    public function testgetRepositoryUrl(): void
    {
        $this->assertSame('https://github.com/foo/bar', $this->searchResult->getRepositoryUrl());
    }

    public function testGetNumberOfDownloads(): void
    {
        $this->assertSame(1, $this->searchResult->getNumberOfDownloads());
    }

    public function testGetNumberOfFavorites(): void
    {
        $this->assertSame(2, $this->searchResult->getNumberOfFavorites());
    }
}
