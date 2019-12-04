<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\ValueObject;

final class GitHubInformation
{
    private int $numberOfStars;

    private int $numberOfWatchers;

    private int $numberOfForks;

    private int $numberOfOpenIssues;

    public function __construct(int $numberOfStars, int $numberOfWatchers, int $numberOfForks, int $numberOfOpenIssues)
    {
        $this->numberOfStars      = $numberOfStars;
        $this->numberOfWatchers   = $numberOfWatchers;
        $this->numberOfForks      = $numberOfForks;
        $this->numberOfOpenIssues = $numberOfOpenIssues;
    }

    public function getNumberOfStars(): int
    {
        return $this->numberOfStars;
    }

    public function getNumberOfWatchers(): int
    {
        return $this->numberOfWatchers;
    }

    public function getNumberOfForks(): int
    {
        return $this->numberOfForks;
    }

    public function getNumberOfOpenIssues(): int
    {
        return $this->numberOfOpenIssues;
    }
}
