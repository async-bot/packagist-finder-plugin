<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Collection;

use AsyncBot\Plugin\PackagistFinder\ValueObject\SearchResult;

final class SearchResults implements \Iterator
{
    /** @var array<SearchResult> */
    private array $searchResults;

    private int $totalNumberOfResults;

    private ?string $nextPageUrl;

    public function __construct(int $totalNumberOfResults, ?string $nextPageUrl, SearchResult ...$searchResults)
    {
        $this->searchResults        = $searchResults;
        $this->totalNumberOfResults = $totalNumberOfResults;
        $this->nextPageUrl          = $nextPageUrl;
    }

    public function getTotalNumberOfResults(): int
    {
        return $this->totalNumberOfResults;
    }

    public function getNextPageUrl(): ?string
    {
        return $this->nextPageUrl;
    }

    public function current(): SearchResult
    {
        return current($this->searchResults);
    }

    public function next(): void
    {
        next($this->searchResults);
    }

    public function key(): ?int
    {
        return key($this->searchResults);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }

    public function rewind(): void
    {
        reset($this->searchResults);
    }
}
