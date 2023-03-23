<?php

declare(strict_types=1);

namespace App\Model\Resume;

use App\Model\Traits\ActivableTrait;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Skill
{
    use ActivableTrait;

    public function __construct(
        public string $slug,
        public string $name,
        public ?array $versions,
        public ?int $level = 5,
        #[Context([
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d',
        ])]
        public ?\DateTimeInterface $since = null,
        public ?string $description = null,
        public ?string $icon = null,
        public ?string $content = null,
        public ?int $priority = 50,
    ) {
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
