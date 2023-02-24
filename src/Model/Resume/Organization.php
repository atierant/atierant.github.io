<?php

declare(strict_types=1);

namespace App\Model\Resume;

use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Organization
{
    public function __construct(
        public string $slug,
        public ?string $name,
        public ?string $url,
        public ?string $logo,
        public ?string $place,
        public ?string $shortDescription,
        public ?array $tags,
        public ?string $description = null,
    ) {
    }
}
