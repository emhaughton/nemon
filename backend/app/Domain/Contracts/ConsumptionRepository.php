<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\ValueObjects\HourlyConsumption;
use Carbon\CarbonImmutable;

interface ConsumptionRepository
{
    /**
     * @return HourlyConsumption[]
     */
    public function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): array;
}