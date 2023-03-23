<?php

declare(strict_types=1);

namespace App\Model\Resume;

use App\Model\Traits\I18nTrait;
use App\Model\Traits\TaggableTrait;

class Organization
{
    use I18nTrait;
    use TaggableTrait;

    public function __construct(
        public string $slug,
        public ?string $name,
        public ?string $url,
        public ?string $logo,
        public ?string $place,
        public ?string $shortDescription,
        public ?string $content,
        public ?string $description = null,
    ) {
    }
}
