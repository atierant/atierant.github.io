<?php

declare(strict_types=1);

namespace App\Model;

/**
 * An interface for models with a parent object.
 */
interface ChildInterface
{
    public function setParentObject(object $parent): self;

    /**
     * @return object
     */
    public function getParentObject(): ?object;
}
