<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\ValueObjects\HourlyPrice;
use Carbon\CarbonImmutable;

interface PriceRepository
{
    /**
     * @return HourlyPrice[]
     */
    public function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): array;
}