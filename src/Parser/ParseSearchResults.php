<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Parser;

use AsyncBot\Plugin\PackagistFinder\Collection\SearchResults;
use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\SearchResult;

final class ParseSearchResults
{
    /**
     * @param array<string,mixed> $searchResults
     */
    public function parse(array $searchResults): SearchResults
    {
        return new SearchResults(
            $searchResults['total'],
            $searchResults['next'],
            ...$this->parseSearchResults($searchResults['results']),
        );
    }

    /**
     * @param array<int,array<string,mixed>> $results
     * @return array<SearchResult>
     */
    private function parseSearchResults(array $results): array
    {
        return array_map(static function (array $result) {
            return new SearchResult(
                PackageName::fromString($result['name']),
                $result['description'],
                $result['url'],
                $result['repository'],
                $result['downloads'],
                $result['favers'],
            );
        }, $results);
    }
}
