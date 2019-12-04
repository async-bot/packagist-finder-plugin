<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\ValueObject;

final class Version
{
    private string $version;

    private PackageName $packageName;

    private string $description;

    public function __construct(string $version, PackageName $packageName, string $description)
    {
        $this->version     = $version;
        $this->packageName = $packageName;
        $this->description = $description;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getPackageName(): PackageName
    {
        return $this->packageName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
