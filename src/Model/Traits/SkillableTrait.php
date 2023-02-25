<?php

declare(strict_types=1);

namespace App\Model\Traits;

/**
 * Trait for Skills.
 */
trait SkillableTrait
{
    public ?array $skills = null;

    public function getSkills(): ?array
    {
        return $this->skills;
    }

    /**
     * @return SkillableTrait
     */
    public function setSkills(?array $skills): static
    {
        $this->skills = $skills;

        return $this;
    }
}
