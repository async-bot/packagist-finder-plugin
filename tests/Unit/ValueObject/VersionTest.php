<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\ValueObject;

use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Version;
use PHPUnit\Framework\TestCase;

class VersionTest extends TestCase
{
    private Version $version;

    protected function setUp(): void
    {
        $this->version = new Version('dev-master', new PackageName('foo', 'bar'), 'The description');
    }

    public function testGetVersion(): void
    {
        $this->assertSame('dev-master', $this->version->getVersion());
    }

    public function testGetPackageName(): void
    {
        $this->assertSame('foo', $this->version->getPackageName()->getVendor());
        $this->assertSame('bar', $this->version->getPackageName()->getPackage());
    }

    public function testGetDescription(): void
    {
        $this->assertSame('The description', $this->version->getDescription());
    }
}
