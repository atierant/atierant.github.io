<?php

namespace App\Model;

class Category
{
    public function __construct(
        public string $slug,
        public string $name,
    )
    {
    }
}
