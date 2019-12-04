<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\Collection;

use AsyncBot\Plugin\PackagistFinder\Collection\SearchResults;
use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\SearchResult;
use PHPUnit\Framework\TestCase;

class SearchResultsTest extends TestCase
{
    private SearchResults $searchResults;

    protected function setUp(): void
    {
        $this->searchResults = new SearchResults(
            1243,
            'https://packagist.org/search.json?page=2&tags%5B0%5D=amphp',
            new SearchResult(
                PackageName::fromString('test/test1'),
                'This is test 1',
                'https://packagist.org/packages/test/test1',
                'https://github.com/test/test1',
                13,
                9,
            ),
            new SearchResult(
                PackageName::fromString('test/test2'),
                'This is test 2',
                'https://packagist.org/packages/test/test2',
                'https://github.com/test/test2',
                14,
                10,
            ),
            new SearchResult(
                PackageName::fromString('test/test3'),
                'This is test 3',
                'https://packagist.org/packages/test/test3',
                'https://github.com/test/test3',
                15,
                11,
            ),
        );
    }

    public function testGetTotalNumberOfResults(): void
    {
        $this->assertSame(1243, $this->searchResults->getTotalNumberOfResults());
    }

    public function testGetNextPageUrl(): void
    {
        $this->assertSame(
            'https://packagist.org/search.json?page=2&tags%5B0%5D=amphp',
            $this->searchResults->getNextPageUrl(),
        );
    }

    public function testIterator(): void
    {
        $expectedData = [
            [
                'name'       => new PackageName('test', 'test1'),
                'description' => 'This is test 1',
                'url'         => 'https://packagist.org/packages/test/test1',
                'repository'  => 'https://github.com/test/test1',
                'downloads'   => 13,
                'favers'      => 9,
            ],
            [
                'name'        => new PackageName('test', 'test2'),
                'description' => 'This is test 2',
                'url'         => 'https://packagist.org/packages/test/test2',
                'repository'  => 'https://github.com/test/test2',
                'downloads'   => 14,
                'favers'      => 10,
            ],
            [
                'name'        => new PackageName('test', 'test3'),
                'description' => 'This is test 3',
                'url'         => 'https://packagist.org/packages/test/test3',
                'repository'  => 'https://github.com/test/test3',
                'downloads'   => 15,
                'favers'      => 11,
            ],
        ];

        foreach ($this->searchResults as $index => $searchResult) {
            $this->assertSame($expectedData[$index]['name']->getVendor(), $searchResult->getPackageName()->getVendor());
            $this->assertSame($expectedData[$index]['name']->getPackage(), $searchResult->getPackageName()->getPackage());
            $this->assertSame($expectedData[$index]['url'], $searchResult->getUrl());
            $this->assertSame($expectedData[$index]['repository'], $searchResult->getRepositoryUrl());
            $this->assertSame($expectedData[$index]['downloads'], $searchResult->getNumberOfDownloads());
            $this->assertSame($expectedData[$index]['favers'], $searchResult->getNumberOfFavorites());
        }
    }
}
