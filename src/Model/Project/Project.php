<?php

declare(strict_types=1);

namespace App\Model\Project;

use App\Model\Traits\TaggableTrait;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Project
{
    use TaggableTrait;

    public function __construct(
        public string $slug,
        public string $title,
        public ?string $subtitle,
        public ?string $description,
        public string $content,
        public ?string $image,
        public ?string $githubRepository,
        public ?array $githubBadges,
        #[Context([
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d',
        ])]
        public \DateTimeInterface $publishedAt,
        public ?\DateTimeInterface $lastModified = null,
    ) {
    }
}
