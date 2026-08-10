<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Carbon\CarbonImmutable;

final readonly class HourlyConsumption
{
    public function __construct(
        private CarbonImmutable $date,
        private int $hour,
        private float $consumption,
    ) {
    }

    public function date(): CarbonImmutable
    {
        return $this->date;
    }

    public function hour(): int
    {
        return $this->hour;
    }

    public function consumption(): float
    {
        return $this->consumption;
    }
}