<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Carbon\CarbonImmutable;

final readonly class HourlyPrice
{
    public function __construct(
        private CarbonImmutable $date,
        private int $hour,
        private float $price,
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

    public function price(): float
    {
        return $this->price;
    }
}