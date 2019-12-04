<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Exception;

final class InvalidPackageName extends Exception
{
    public function __construct(string $packageName)
    {
        parent::__construct(
            sprintf('%s is not a valid package name', $packageName),
        );
    }
}
