<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\ValueObject;

use AsyncBot\Plugin\PackagistFinder\Exception\InvalidPackageName;

final class PackageName
{
    private string $vendor;

    private string $package;

    public function __construct(string $vendor, string $package)
    {
        $this->vendor  = $vendor;
        $this->package = $package;
    }

    public static function fromString(string $packageName): self
    {
        if (preg_match('~^(?P<vendor>[^/]+)/(?P<package>[^/]+)$~', $packageName, $matches) !== 1) {
            throw new InvalidPackageName($packageName);
        }

        return new self(
            $matches['vendor'],
            $matches['package'],
        );
    }

    public function getVendor(): string
    {
        return $this->vendor;
    }

    public function getPackage(): string
    {
        return $this->package;
    }
}
