<?php

namespace App\Model\Project;

use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Project
{
    public function __construct(
        public string $slug,
        public string $title,
        public ?string $subtitle,
        public ?string $description,
        public string $content,
        public ?string $image,
        public ?array $tags,
        public ?string $githubRepository,
        public ?array $githubBadges,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
        public \DateTimeInterface $publishedAt,
        public ?\DateTimeInterface $lastModified = null,
    )
    {
    }
}
