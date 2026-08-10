<?php

declare(strict_types=1);

namespace App\Application\DTOs;

final readonly class CalculateIndexedPriceResponse
{
    public function __construct(
        public float $indexedPrice,
    ) {
    }
}