<?php

namespace App\Model\Note;

use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Note
{
    public function __construct(
        public string $slug,
        public string $title,
        public string $content,
        public ?string $category,
        public ?string $image,
        public ?array $tags,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
        public \DateTimeInterface $publishedAt,
        public ?\DateTimeInterface $lastModified = null,
        public ?NoteColorEnum $color = NoteColorEnum::yellow,
    )
    {
    }
}
