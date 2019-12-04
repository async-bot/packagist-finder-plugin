<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\ValueObject;

use AsyncBot\Plugin\PackagistFinder\ValueObject\Maintainer;
use PHPUnit\Framework\TestCase;

class MaintainerTest extends TestCase
{
    private Maintainer $maintainer;

    protected function setUp(): void
    {
        $this->maintainer = new Maintainer('Test User', 'https://example.com');
    }

    public function testGetName(): void
    {
        $this->assertSame('Test User', $this->maintainer->getName());
    }

    public function testGetAvatarUrl(): void
    {
        $this->assertSame('https://example.com', $this->maintainer->getAvatarUrl());
    }
}
