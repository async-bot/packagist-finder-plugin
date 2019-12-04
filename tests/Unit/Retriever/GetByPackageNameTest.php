<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\Retriever;

use Amp\Http\Client\HttpClientBuilder;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\PackagistFinder\Retriever\GetByPackageName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Package;
use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use AsyncBot\Plugin\PackagistFinderTest\Fakes\HttpClient\ResponseInterceptor;
use PHPUnit\Framework\TestCase;
use function Amp\Promise\wait;

class GetByPackageNameTest extends TestCase
{
    public function testRetrieve(): void
    {
        $httpClient = new Client((new HttpClientBuilder())->intercept(
            new ResponseInterceptor(file_get_contents(TEST_DATA_DIR . '/Response/get-monolog-monolog-package.json')),
        )->build());

        $package = wait((new GetByPackageName($httpClient))->retrieve(new PackageName('monolog', 'monolog')));

        $this->assertInstanceOf(Package::class, $package);
    }
}
