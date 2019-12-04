<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Fakes\HttpClient;

use Amp\ByteStream\InMemoryStream;
use Amp\CancellationToken;
use Amp\Http\Client\ApplicationInterceptor;
use Amp\Http\Client\DelegateHttpClient;
use Amp\Http\Client\Request;
use Amp\Http\Client\Response;
use Amp\Promise;
use Amp\Success;

final class ResponseInterceptor implements ApplicationInterceptor
{
    private string $body;

    private int $statusCode;

    public function __construct(string $body, int $statusCode = 200)
    {
        $this->body       = $body;
        $this->statusCode = $statusCode;
    }

    /**
     * phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     *
     * @return Promise<Response>
     */
    public function request(Request $request, CancellationToken $cancellation, DelegateHttpClient $client): Promise
    {
        // phpcs:enable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
        $body = new InMemoryStream($this->body);

        return new Success(
            new Response('2', $this->statusCode, 'OK', [], $body, $request),
        );
    }
}
