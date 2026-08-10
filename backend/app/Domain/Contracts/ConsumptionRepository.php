<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\Exceptions\MissingDateRangeException;
use App\Domain\ValueObjects\HourlyConsumption;
use Carbon\CarbonImmutable;

interface ConsumptionRepository
{
    /**
     * @throws MissingDateRangeException
     * 
     * @return HourlyConsumption[]
     */
    public function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): array;
}