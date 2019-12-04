<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\ValueObject;

final class SearchResult
{
    private PackageName $packageName;

    private string $description;

    private string $url;

    private string $repositoryUrl;

    private int $numberOfDownloads;

    private int $numberOfFavorites;

    public function __construct(
        PackageName $packageName,
        string $description,
        string $url,
        string $repositoryUrl,
        int $numberOfDownloads,
        int $numberOfFavorites
    ) {
        $this->packageName       = $packageName;
        $this->description       = $description;
        $this->url               = $url;
        $this->repositoryUrl     = $repositoryUrl;
        $this->numberOfDownloads = $numberOfDownloads;
        $this->numberOfFavorites = $numberOfFavorites;
    }

    public function getPackageName(): PackageName
    {
        return $this->packageName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getRepositoryUrl(): string
    {
        return $this->repositoryUrl;
    }

    public function getNumberOfDownloads(): int
    {
        return $this->numberOfDownloads;
    }

    public function getNumberOfFavorites(): int
    {
        return $this->numberOfFavorites;
    }
}
