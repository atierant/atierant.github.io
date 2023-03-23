<?php

declare(strict_types=1);

namespace App\Model;

class Category
{
    public function __construct(
        public string $slug,
        public string $name,
    ) {
    }
}
