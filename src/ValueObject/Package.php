<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\ValueObject;

use AsyncBot\Plugin\PackagistFinder\Collection\Maintainers;
use AsyncBot\Plugin\PackagistFinder\Collection\Versions;

final class Package
{
    private PackageName $packageName;

    private string $description;

    private \DateTimeImmutable $createdAt;

    private Maintainers $maintainers;

    private Versions $versions;

    private string $type;

    private string $repositoryUrl;

    private GitHubInformation $gitHubInformation;

    private string $language;

    private int $numberOfDependent;

    private int $numberOfSuggesters;

    private NumberOfDownloads $numberOfDownloads;

    private int $numberOfFavorites;

    public function __construct(
        PackageName $packageName,
        string $description,
        \DateTimeImmutable $createdAt,
        Maintainers $maintainers,
        Versions $versions,
        string $type,
        string $repositoryUrl,
        GitHubInformation $gitHubInformation,
        string $language,
        int $numberOfDependent,
        int $numberOfSuggesters,
        NumberOfDownloads $numberOfDownloads,
        int $numberOfFavorites
    ) {
        $this->packageName       = $packageName;
        $this->description        = $description;
        $this->createdAt          = $createdAt;
        $this->maintainers        = $maintainers;
        $this->versions           = $versions;
        $this->type               = $type;
        $this->repositoryUrl      = $repositoryUrl;
        $this->gitHubInformation  = $gitHubInformation;
        $this->language           = $language;
        $this->numberOfDependent  = $numberOfDependent;
        $this->numberOfSuggesters = $numberOfSuggesters;
        $this->numberOfDownloads  = $numberOfDownloads;
        $this->numberOfFavorites  = $numberOfFavorites;
    }

    public function getPackageName(): PackageName
    {
        return $this->packageName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getMaintainers(): Maintainers
    {
        return $this->maintainers;
    }

    public function getVersions(): Versions
    {
        return $this->versions;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getRepositoryUrl(): string
    {
        return $this->repositoryUrl;
    }

    public function getGitHubInformation(): GitHubInformation
    {
        return $this->gitHubInformation;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getNumberOfDependent(): int
    {
        return $this->numberOfDependent;
    }

    public function getNumberOfSuggesters(): int
    {
        return $this->numberOfSuggesters;
    }

    public function getNumberOfDownloads(): NumberOfDownloads
    {
        return $this->numberOfDownloads;
    }

    public function getNumberOfFavorites(): int
    {
        return $this->numberOfFavorites;
    }
}
