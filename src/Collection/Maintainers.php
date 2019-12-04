<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Collection;

use AsyncBot\Plugin\PackagistFinder\ValueObject\Maintainer;

final class Maintainers implements \Iterator
{
    /** @var array<Maintainer> */
    private array $maintainers;

    public function __construct(Maintainer ...$maintainers)
    {
        $this->maintainers = $maintainers;
    }

    public function current(): Maintainer
    {
        return current($this->maintainers);
    }

    public function next(): void
    {
        next($this->maintainers);
    }

    public function key(): ?int
    {
        return key($this->maintainers);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }

    public function rewind(): void
    {
        reset($this->maintainers);
    }
}
