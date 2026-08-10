<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\Exceptions\MissingDateRangeException;
use App\Domain\ValueObjects\HourlyPrice;
use Carbon\CarbonImmutable;

interface PriceRepository
{
    /**
    * @throws MissingDateRangeException
     * 
     * @return HourlyPrice[]
     */
    public function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): array;
}