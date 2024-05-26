<?php

namespace App\Services;

class TypesHinter
{
    public function setAttribute(int|float $attribute): self
    {
        return $this;
    }

    public function noReturn(): void
    {
    }
}