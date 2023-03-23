<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Traits\ActivableTrait;
use Stenope\Bundle\Attribute\SuggestedDebugQuery;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Validator\Constraints as Assert;

#[SuggestedDebugQuery('Active', filters: '_.active', orders: 'desc:since')]
class Author
{
    use ActivableTrait;

    public function __construct(
        public string $slug,
        public string $name,
        #[Assert\Url]
        public ?string $website = null,
        #[Assert\Email]
        public ?string $mail = null,
        public ?string $avatar = null,
        #[Context([
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d',
        ])]
        public ?\DateTimeInterface $since = null,
        public ?\DateTimeInterface $lastModified = null,
    ) {
    }
}
