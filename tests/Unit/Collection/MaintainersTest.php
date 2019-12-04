<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinderTest\Unit\Collection;

use AsyncBot\Plugin\PackagistFinder\Collection\Maintainers;
use AsyncBot\Plugin\PackagistFinder\ValueObject\Maintainer;
use PHPUnit\Framework\TestCase;

class MaintainersTest extends TestCase
{
    public function testIterator(): void
    {
        $maintainers = new Maintainers(
            new Maintainer('Test User 1', 'https://www.gravatar.com/avatar/1?d=identicon'),
            new Maintainer('Test User 2', 'https://www.gravatar.com/avatar/2?d=identicon'),
            new Maintainer('Test User 3', 'https://www.gravatar.com/avatar/3?d=identicon'),
        );

        $expectedData = [
            [
                'name'      => 'Test User 1',
                'avatarUrl' => 'https://www.gravatar.com/avatar/1?d=identicon',
            ],
            [
                'name'      => 'Test User 2',
                'avatarUrl' => 'https://www.gravatar.com/avatar/2?d=identicon',
            ],
            [
                'name'      => 'Test User 3',
                'avatarUrl' => 'https://www.gravatar.com/avatar/3?d=identicon',
            ],
        ];

        foreach ($maintainers as $index => $maintainer) {
            $this->assertSame($expectedData[$index]['name'], $maintainer->getName());
            $this->assertSame($expectedData[$index]['avatarUrl'], $maintainer->getAvatarUrl());
        }
    }
}
