<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Carbon\CarbonImmutable;

final readonly class HourlyMeasurement
{
    public function __construct(
        private CarbonImmutable $date,
        private int $hour,
        private float $consumption,
        private float $omiePrice,
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

    public function omiePrice(): float
    {
        return $this->omiePrice;
    }
}