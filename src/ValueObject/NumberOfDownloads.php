<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\ValueObject;

final class NumberOfDownloads
{
    private int $total;

    private int $monthly;

    private int $daily;

    public function __construct(int $total, int $monthly, int $daily)
    {
        $this->total   = $total;
        $this->monthly = $monthly;
        $this->daily   = $daily;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getMonthly(): int
    {
        return $this->monthly;
    }

    public function getDaily(): int
    {
        return $this->daily;
    }
}
