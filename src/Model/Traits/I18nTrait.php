<?php

declare(strict_types=1);

namespace App\Model\Traits;

/**
 * Trait for Lang.
 */
trait I18nTrait
{
    public ?string $lang = null;

    public function getLang(): ?string
    {
        return $this->lang;
    }

    /**
     * @return i18nTrait
     */
    public function setLang(?string $lang): static
    {
        $this->lang = $lang;

        return $this;
    }
}
