<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\Parser;

use AsyncBot\Plugin\PackagistFinder\Collection\SearchResults;
use AsyncBot\Plugin\PackagistFinder\Parser\ParseSearchResults;
use PHPUnit\Framework\TestCase;
use function ExceptionalJSON\decode;

class ParseSearchResultsTest extends TestCase
{
    private SearchResults $searchResults;

    protected function setUp(): void
    {
        $this->searchResults = (new ParseSearchResults())
            ->parse(
                decode(file_get_contents(TEST_DATA_DIR . '/Response/search-monolog-name.json'), true),
            )
        ;
    }

    public function testNumberOTotalResultsIsParsedCorrectly(): void
    {
        $this->assertSame(629, $this->searchResults->getTotalNumberOfResults());
    }

    public function testNextPageUrlIsParsedCorrectly(): void
    {
        $this->assertSame('https://packagist.org/search.json?q=monolog&page=2', $this->searchResults->getNextPageUrl());
    }

    public function testSearchResultsAreParsedCorrectly(): void
    {
        $results = iterator_to_array($this->searchResults);

        $this->assertCount(15, $results);
    }

    public function testPackageNameIsParsedCorrectly(): void
    {
        $results = iterator_to_array($this->searchResults);

        $this->assertSame('monolog', $results[0]->getPackageName()->getVendor());
        $this->assertSame('monolog', $results[0]->getPackageName()->getPackage());
    }

    public function testDescriptionIsParsedCorrectly(): void
    {
        $results = iterator_to_array($this->searchResults);

        $this->assertSame(
            'Sends your logs to files, sockets, inboxes, databases and various web services',
            $results[0]->getDescription(),
        );
    }

    public function testUrlIsParsedCorrectly(): void
    {
        $results = iterator_to_array($this->searchResults);

        $this->assertSame('https://packagist.org/packages/monolog/monolog', $results[0]->getUrl());
    }

    public function testRepositoryUrlIsParsedCorrectly(): void
    {
        $results = iterator_to_array($this->searchResults);

        $this->assertSame('https://github.com/Seldaek/monolog', $results[0]->getRepositoryUrl());
    }

    public function testNumberOfDownloadsIsParsedCorrectly(): void
    {
        $results = iterator_to_array($this->searchResults);

        $this->assertSame(173717630, $results[0]->getNumberOfDownloads());
    }

    public function testNumberOfFavoritesIsParsedCorrectly(): void
    {
        $results = iterator_to_array($this->searchResults);

        $this->assertSame(16793, $results[0]->getNumberOfFavorites());
    }
}
