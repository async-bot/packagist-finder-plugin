<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\ValueObject;

final class Maintainer
{
    private string $name;

    private string $avatarUrl;

    public function __construct(string $name, string $avatarUrl)
    {
        $this->name      = $name;
        $this->avatarUrl = $avatarUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }
}
