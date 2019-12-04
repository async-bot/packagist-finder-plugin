<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Collection;

use AsyncBot\Plugin\PackagistFinder\ValueObject\Version;

final class Versions implements \Iterator, \Countable
{
    /** @var array<Version> */
    private array $versions;

    public function __construct(Version ...$versions)
    {
        $this->versions = $versions;
    }

    public function current(): Version
    {
        return current($this->versions);
    }

    public function next(): void
    {
        next($this->versions);
    }

    public function key(): ?int
    {
        return key($this->versions);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }

    public function rewind(): void
    {
        reset($this->versions);
    }

    public function count(): int
    {
        return count($this->versions);
    }
}
