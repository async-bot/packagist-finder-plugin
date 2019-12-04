<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\ValueObject;

use AsyncBot\Plugin\PackagistFinder\Exception\InvalidPackageName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use PHPUnit\Framework\TestCase;

class PackageNameTest extends TestCase
{
    private PackageName $packageName;

    protected function setUp(): void
    {
        $this->packageName = new PackageName('the-vendor', 'the-package');
    }

    public function testGetVendor(): void
    {
        $this->assertSame('the-vendor', $this->packageName->getVendor());
    }

    public function testGetPackage(): void
    {
        $this->assertSame('the-package', $this->packageName->getPackage());
    }

    public function testFromString(): void
    {
        $packageName = PackageName::fromString('the-vendor/the-package');

        $this->assertSame('the-vendor', $packageName->getVendor());
        $this->assertSame('the-package', $packageName->getPackage());
    }

    public function testFromStringThrowsOnInvalidPackageName(): void
    {
        $this->expectException(InvalidPackageName::class);
        $this->expectExceptionMessage('foobar is not a valid package name');

        PackageName::fromString('foobar');
    }
}
