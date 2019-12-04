<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\Retriever;

use Amp\Http\Client\HttpClientBuilder;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\PackagistFinder\Collection\SearchResults;
use AsyncBot\Plugin\PackagistFinder\Retriever\SearchByTag;
use AsyncBot\Plugin\PackagistFinderTest\Fakes\HttpClient\ResponseInterceptor;
use PHPUnit\Framework\TestCase;
use function Amp\Promise\wait;

class SearchByTagTest extends TestCase
{
    public function testRetrieve(): void
    {
        $httpClient = new Client((new HttpClientBuilder())->intercept(
            new ResponseInterceptor(file_get_contents(TEST_DATA_DIR . '/Response/search-monolog-name.json')),
        )->build());

        $searchResults = wait((new SearchByTag($httpClient))->retrieve('monolog'));

        $this->assertInstanceOf(SearchResults::class, $searchResults);
    }
}
