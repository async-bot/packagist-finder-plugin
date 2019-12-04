<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Retriever;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\PackagistFinder\Collection\SearchResults;
use AsyncBot\Plugin\PackagistFinder\Parser\ParseSearchResults;
use AsyncBot\Plugin\PackagistFinder\Validation\JsonSchema\SearchResultResponse;
use function Amp\call;

final class SearchByName
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Promise<SearchResults>
     */
    public function retrieve(string $name): Promise
    {
        return call(function () use ($name) {
            return (new ParseSearchResults())->parse(
                yield $this->httpClient->requestJson(
                    sprintf(
                        'https://packagist.org/search.json?q=%s',
                        urlencode($name),
                    ),
                    new SearchResultResponse(),
                ),
            );
        });
    }
}
