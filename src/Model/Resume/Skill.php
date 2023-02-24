<?php

declare(strict_types=1);

namespace App\Model\Resume;

use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Skill
{
    public function __construct(
        public string $slug,
        public string $name,
        public ?array $versions,
        public ?int $level = 5,
        public bool $active = true,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
        public ?\DateTimeInterface $since = null,
        public ?string $description = null,
        public ?int $priority = 50,
    ) {
    }
}
