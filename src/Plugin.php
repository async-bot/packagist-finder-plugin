<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\PackagistFinder\Collection\SearchResults;
use AsyncBot\Plugin\PackagistFinder\Exception\InvalidPackageName;
use AsyncBot\Plugin\PackagistFinder\Retriever\GetByPackageName;
use AsyncBot\Plugin\PackagistFinder\Retriever\SearchByName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Package;
use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;

final class Plugin
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Promise<Package>
     * @throws InvalidPackageName
     */
    public function getByPackageName(string $packageName): Promise
    {
        $package = PackageName::fromString($packageName);

        return (new GetByPackageName($this->httpClient))->retrieve($package);
    }

    /**
     * @return Promise<SearchResults>
     */
    public function searchByName(string $name): Promise
    {
        return (new SearchByName($this->httpClient))->retrieve($name);
    }
}
