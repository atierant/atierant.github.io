<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class NumberExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('random_orientation', [$this, 'randomOrientation']),
        ];
    }

    public function randomOrientation(): int
    {
        return array_rand(array_merge(range(355, 359), range(0, 5)));
    }
}
