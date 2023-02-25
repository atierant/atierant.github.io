<?php

declare(strict_types=1);

namespace App\Model\Traits;

/**
 * Trait for Tag.
 */
trait TaggableTrait
{
    public ?array $tags = null;

    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @return TaggableTrait
     */
    public function setTags(?array $tags): static
    {
        $this->tags = $tags;

        return $this;
    }
}
