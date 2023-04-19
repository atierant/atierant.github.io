<?php

declare(strict_types=1);

namespace App\Model\Resume;

use App\Model\Traits\ActivableTrait;
use App\Model\Traits\I18nTrait;
use App\Model\Traits\SkillableTrait;
use App\Model\Traits\TaggableTrait;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Work
{
    use I18nTrait;
    use TaggableTrait;
    use SkillableTrait;
    use ActivableTrait;

    public function __construct(
        public string $slug,
        public ?string $organization,
        public ?string $role,
        public ?string $content,
        public ?array $missions,
        #[Context([
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d',
        ])]
        public ?\DateTimeInterface $startDate = null,
        #[Context([
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d',
        ])]
        public ?\DateTimeInterface $endDate = null,
        public ?string $description = null,
    ) {
    }
}