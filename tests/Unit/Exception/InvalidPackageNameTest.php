<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\Exception;

use AsyncBot\Plugin\PackagistFinder\Exception\InvalidPackageName;
use PHPUnit\Framework\TestCase;

class InvalidPackageNameTest extends TestCase
{
    public function testConstructorFormatsMessageCorrectly(): void
    {
        $this->expectException(InvalidPackageName::class);
        $this->expectExceptionMessage('foo/bar is not a valid package name');

        throw new InvalidPackageName('foo/bar');
    }
}
