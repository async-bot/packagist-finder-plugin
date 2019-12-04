<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\ValueObject;

use AsyncBot\Plugin\PackagistFinder\ValueObject\NumberOfDownloads;
use PHPUnit\Framework\TestCase;

class NumberOfDownloadsTest extends TestCase
{
    private NumberOfDownloads $numberOfDownloads;

    protected function setUp(): void
    {
        $this->numberOfDownloads = new NumberOfDownloads(3, 2, 1);
    }

    public function testGetTotal(): void
    {
        $this->assertSame(3, $this->numberOfDownloads->getTotal());
    }

    public function testGetMonthly(): void
    {
        $this->assertSame(2, $this->numberOfDownloads->getMonthly());
    }

    public function testGetDaily(): void
    {
        $this->assertSame(1, $this->numberOfDownloads->getDaily());
    }
}
