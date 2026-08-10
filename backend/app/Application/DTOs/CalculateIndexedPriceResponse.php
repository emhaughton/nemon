<?php

declare(strict_types=1);

namespace App\Application\DTOs;

use App\Domain\ValueObjects\IndexedPrice;

final readonly class CalculateIndexedPriceResponse
{
    public function __construct(
        public IndexedPrice $indexedPrice,
    ) {
    }
}