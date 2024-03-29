<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig;

use Symfony\Component\Intl\Locales;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * See https://symfony.com/doc/current/templating/twig_extension.html.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Julien ITARD <julienitard@gmail.com>
 */
class AppExtension extends AbstractExtension
{
    /**
     * @var string[]
     */
    private array $localeCodes;

    /**
     * @var list<array{code: string, name: string}>|null
     */
    private ?array $locales = null;

    // The $locales argument is injected thanks to the service container.
    // See https://symfony.com/doc/current/service_container.html#binding-arguments-by-name-or-type
    public function __construct(string $locales)
    {
        $localeCodes = explode('|', $locales);
        sort($localeCodes);
        $this->localeCodes = $localeCodes;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('locales', [$this, 'getLocales']),
            new TwigFunction('flag', [$this, 'getEmojiFlag']),
        ];
    }

    /**
     * Takes the list of codes of the locales (languages) enabled in the
     * application and returns an array with the name of each locale written
     * in its own language (e.g. English, Français, Español, etc.).
     *
     * @return array<int, array<string, string, string>>
     */
    public function getLocales(): array
    {
        if ($this->locales !== null) {
            return $this->locales;
        }

        $this->locales = [];

        foreach ($this->localeCodes as $localeCode) {
            $this->locales[] = [
                'code' => $localeCode,
                'name' => Locales::getName($localeCode, $localeCode),
                'flag' => $this->getEmojiFlag(mb_strtoupper($localeCode)),
            ];
        }

        return $this->locales;
    }

    /**
     * Takes the list of codes of the locales (languages) enabled in the
     * application and returns an array with the name of each locale written
     * in its own language (e.g. English, Français, Español, etc.).
     *
     * @return array<int, array<string, string>>
     */
    public function getEmojiFlag(string $countryCode): string
    {
        $countryCode = mb_strtoupper($countryCode);
        if ($countryCode === 'EN') {
            $countryCode = 'US';
        }

        $chr1 = mb_convert_encoding('&#' . (127397 + ord($countryCode[0])) . ';', 'UTF-8', 'HTML-ENTITIES');
        $chr2 = mb_convert_encoding('&#' . (127397 + ord($countryCode[1])) . ';', 'UTF-8', 'HTML-ENTITIES');

        return $chr1 . $chr2;
    }
}
