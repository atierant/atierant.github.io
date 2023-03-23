<?php

declare(strict_types=1);

namespace App\Twig;

use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\String\UnicodeString;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class StringExtension extends AbstractExtension
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger = null)
    {
        $this->slugger = $slugger ?? new AsciiSlugger();
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('local_slug', [$this, 'createSlug']),
        ];
    }

    public function createUnicodeString(?string $text): UnicodeString
    {
        return new UnicodeString($text ?? '');
    }

    public function createSlug(string $string, string $separator = '-', ?string $locale = null): string
    {
        return mb_strtolower($this->slugger->slug($string, $separator, $locale)->toString());
    }
}
