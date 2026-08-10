<?php

declare(strict_types=1);

namespace App\Application\DTOs;

use App\Domain\ValueObjects\Formula;
use Carbon\CarbonImmutable;

final readonly class CalculateIndexedPriceRequest
{
    public function __construct(
        public CarbonImmutable $from,
        public CarbonImmutable $to,
        public Formula $formula,
    ) {
    }
}