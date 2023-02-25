<?php

declare(strict_types=1);

namespace App\Model\Note;

enum NoteColorEnum: string
{
    case blue = 'blue';
    case green = 'green';
    case yellow = 'yellow';
    case brown = 'brown';
    case purple = 'purple';
    case orange = 'orange';

    public function getColor(): string
    {
        return $this->name;
    }
}
