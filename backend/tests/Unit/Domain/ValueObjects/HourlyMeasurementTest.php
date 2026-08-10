<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\HourlyMeasurement;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;

final class HourlyMeasurementTest extends TestCase
{
    public function test_it_stores_hourly_data(): void
    {
        $date = CarbonImmutable::parse('2025-01-01');

        $measurement = new HourlyMeasurement(
            date: $date,
            hour: 8,
            consumption: 1.5,
            omiePrice: 0.123,
        );

        $this->assertSame($date, $measurement->date());
        $this->assertSame(8, $measurement->hour());
        $this->assertSame(1.5, $measurement->consumption());
        $this->assertSame(0.123, $measurement->omiePrice());
    }
}