<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Retriever;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\PackagistFinder\Parser\ParsePackageInformation;
use AsyncBot\Plugin\PackagistFinder\Validation\JsonSchema\GetByPackageNameResponse;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Package;
use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use function Amp\call;

final class GetByPackageName
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Promise<Package>
     */
    public function retrieve(PackageName $packageName): Promise
    {
        return call(function () use ($packageName) {
            return (new ParsePackageInformation())->parse(
                yield $this->httpClient->requestJson(
                    sprintf(
                        'https://packagist.org/packages/%s/%s.json',
                        $packageName->getVendor(),
                        $packageName->getPackage(),
                    ),
                    new GetByPackageNameResponse(),
                ),
            );
        });
    }
}
