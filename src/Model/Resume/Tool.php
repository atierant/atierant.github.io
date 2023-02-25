<?php

declare(strict_types=1);

namespace App\Model\Resume;

use App\Model\Traits\TaggableTrait;

class Tool
{
    use TaggableTrait;

    public function __construct(
        public string $slug,
        public ?string $name,
        public ?string $url,
        public ?string $logo,
        public ?string $shortDescription,
        public ?string $description = null,
    ) {
    }
}
