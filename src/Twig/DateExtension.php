<?php

declare(strict_types=1);

namespace App\Twig;

use App\Helper\PluralizeHelper;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DateExtension extends AbstractExtension
{
    public function __construct(
        readonly private TranslatorInterface $translator
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_duration', [$this, 'getDuration']),
        ];
    }

    public function getDuration(
        \DateTimeInterface $dateStart,
        \DateTimeInterface $dateEnd = null,
        array $options = ['y', 'm'],
        bool $asString = true,
    ): \DateInterval|string {
        if ($dateEnd === null) {
            $dateEnd = new \DateTimeImmutable();
        }

        $interval = $dateStart->diff($dateEnd);

        return $asString ? $this->formatInterval($interval, $options) : $interval;
    }

    /**
     * Format an interval to show all existing components.
     * If the interval doesn't have a time component (years, months, etc)
     * That component won't be displayed.
     *
     * @param \DateInterval $interval The interval
     *
     * @return string Formatted interval string.
     */
    public function formatInterval(\DateInterval $interval, array $options = []): string
    {
        $result = '';
        if ((in_array('y', $options, true)) && ($interval->y !== 0)) {
            $result .= $interval->format('%y')
                . ' '
                . PluralizeHelper::pluralize($interval->y, $this->translator->trans('year'), $this->translator->trans('years'));
        }
        if ((in_array('m', $options, true)) && ($interval->m !== 0)) {
            $result .= $interval->y !== 0 ? ' ' : '';
            $result .= $interval->format('%m')
                . ' '
                . PluralizeHelper::pluralize($interval->m, $this->translator->trans('month'), $this->translator->trans('months'));
        }
        if ((in_array('d', $options, true)) && ($interval->d !== 0)) {
            $result .= ($interval->y !== 0 || $interval->m !== 0) ? ' ' : '';
            $result .= $interval->format('%d')
                . ' '
                . PluralizeHelper::pluralize($interval->d, $this->translator->trans('day'), $this->translator->trans('days'));
        }
        if ((in_array('h', $options, true)) && ($interval->h !== 0)) {
            $result .= ($interval->y !== 0 || $interval->m !== 0 || $interval->d !== 0) ? ' ' : '';
            $result .= $interval->format('%h')
                . ' '
                . PluralizeHelper::pluralize($interval->h, $this->translator->trans('hour'), $this->translator->trans('hours'));
        }
        if ((in_array('i', $options, true)) && ($interval->i !== 0)) {
            $result .= ($interval->y !== 0 || $interval->m !== 0 || $interval->d !== 0 || $interval->h !== 0) ? ' ' : '';
            $result .= $interval->format('%i')
                . ' '
                . PluralizeHelper::pluralize($interval->i, $this->translator->trans('minute'), $this->translator->trans('minutes'));
        }
        if ((in_array('s', $options, true)) && ($interval->s !== 0)) {
            $result .= ($interval->y !== 0 || $interval->m !== 0 || $interval->d !== 0 || $interval->h !== 0 || $interval->i !== 0) ? ' ' : '';
            $result .= $interval->format('%s')
                . ' '
                . PluralizeHelper::pluralize($interval->s, $this->translator->trans('second'), $this->translator->trans('seconds'));
        }

        return $result;
    }
}
