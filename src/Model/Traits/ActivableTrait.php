<?php

declare(strict_types=1);

namespace App\Model\Traits;

/**
 * Trait for Actives.
 */
trait ActivableTrait
{
    public ?bool $active = true;

    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @return ActivableTrait
     */
    public function setActives(?bool $active): static
    {
        $this->active = $active;

        return $this;
    }
}
