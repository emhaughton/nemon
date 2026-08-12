<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Carbon\CarbonImmutable;

final readonly class DailyHourlyValues
{
    /**
     * @param array<int,float> $hourlyValues
     */
    public function __construct(
        private CarbonImmutable $date,
        private array $hourlyValues,
    ) {
    }

    public function date(): CarbonImmutable
    {
        return $this->date;
    }

    /**
     * @return array<int,float>
     */
    public function hourlyValues(): array
    {
        return $this->hourlyValues;
    }
}