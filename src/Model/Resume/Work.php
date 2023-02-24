<?php

declare(strict_types=1);

namespace App\Model\Resume;

use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Work
{
    public function __construct(
        public string $slug,
        public ?string $organization,
        public ?string $role,
        public ?string $content,
        public ?array $missions,
        public ?array $skills,
        public ?array $tags,
        public bool $active = true,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
        public ?\DateTimeInterface $startDate = null,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
        public ?\DateTimeInterface $endDate = null,
        public ?string $description = null,
    ) {
    }
}
