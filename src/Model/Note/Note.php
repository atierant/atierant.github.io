<?php

declare(strict_types=1);

namespace App\Model\Note;

use App\Model\Traits\ActivableTrait;
use App\Model\Traits\TaggableTrait;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Note
{
    use TaggableTrait;
    use ActivableTrait;

    public function __construct(
        public string $slug,
        public string $title,
        public string $content,
        public ?string $category,
        public ?string $image,
        #[Context([
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d',
        ])]
        public \DateTimeInterface $publishedAt,
        public ?\DateTimeInterface $lastModified = null,
        public ?NoteColorEnum $color = NoteColorEnum::yellow,
    ) {
    }
}
