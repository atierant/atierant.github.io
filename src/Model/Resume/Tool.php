<?php

declare(strict_types=1);

namespace App\Model\Resume;

class Tool
{
    public function __construct(
        public string $slug,
        public ?string $name,
        public ?string $url,
        public ?string $logo,
        public ?string $shortDescription,
        public ?array $tags,
        public ?string $description = null,
    )
    {
    }
}
