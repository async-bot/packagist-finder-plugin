<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\Collection;

use AsyncBot\Plugin\PackagistFinder\Collection\Versions;
use AsyncBot\Plugin\PackagistFinder\ValueObject\PackageName;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Version;
use PHPUnit\Framework\TestCase;

class VersionsTest extends TestCase
{
    private Versions $versions;

    protected function setUp(): void
    {
        $this->versions = new Versions(
            new Version('dev-master', new PackageName('test', 'test1'), 'This is description 1'),
            new Version('0.1.0', new PackageName('test', 'test2'), 'This is description 2'),
            new Version('0.0.1', new PackageName('test', 'test3'), 'This is description 3'),
        );
    }

    public function testIterator(): void
    {
        $expected = [
            [
                'version'    => 'dev-master',
                'package'     => new PackageName('test', 'test1'),
                'description' => 'This is description 1',
            ],
            [
                'version'    => '0.1.0',
                'package'     => new PackageName('test', 'test2'),
                'description' => 'This is description 2',
            ],
            [
                'version'    => '0.0.1',
                'package'     => new PackageName('test', 'test3'),
                'description' => 'This is description 3',
            ],
        ];

        foreach ($this->versions as $index => $version) {
            $this->assertSame($expected[$index]['version'], $version->getVersion());
            $this->assertSame($expected[$index]['package']->getVendor(), $version->getPackageName()->getVendor());
            $this->assertSame($expected[$index]['package']->getPackage(), $version->getPackageName()->getPackage());
            $this->assertSame($expected[$index]['description'], $version->getDescription());
        }
    }

    public function testCount(): void
    {
        $this->assertSame(3, count($this->versions));
    }
}
