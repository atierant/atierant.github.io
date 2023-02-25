<?php

declare(strict_types=1);

namespace App\Helper;

class PluralizeHelper
{
    /**
     * Pluralizes a word if quantity is not one.
     *
     * @param int $quantity Number of items
     * @param string $singular Singular form of word
     * @param string|null $plural Plural form of word; function will attempt to deduce plural form from singular if not provided
     * @return string Pluralized word if quantity is not one, otherwise singular
     */
    public static function pluralize(int $quantity, string $singular, string $plural = null): string
    {
        if ($quantity === 1 || ! strlen($singular)) {
            return $singular;
        }
        if ($plural !== null) {
            return $plural;
        }

        $last_letter = strtolower($singular[strlen($singular) - 1]);
        return match ($last_letter) {
            'y' => substr($singular, 0, -1) . 'ies',
            's' => $singular . 'es',
            default => $singular . 's',
        };
    }
}
