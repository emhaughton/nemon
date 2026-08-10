<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

final readonly class IndexedPrice
{
    public function __construct(
        private float $value,
    ) {
    }

    public function value(): float
    {
        return $this->value;
    }
}