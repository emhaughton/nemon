<?php

declare(strict_types=1);

use App\Domain\ValueObjects\HourlyConsumption;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;

final class HourlyConsumptionTest extends TestCase
{
    public function test_it_stores_hourly_consumption(): void
    {
        $date = CarbonImmutable::parse('2025-01-01');

        $consumption = new HourlyConsumption(
            $date,
            8,
            2.5,
        );

        $this->assertSame($date, $consumption->date());
        $this->assertSame(8, $consumption->hour());
        $this->assertSame(2.5, $consumption->consumption());
    }
}