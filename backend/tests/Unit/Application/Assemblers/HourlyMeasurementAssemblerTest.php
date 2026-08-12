<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Assemblers;

use App\Application\Assemblers\HourlyMeasurementAssembler;
use App\Domain\ValueObjects\HourlyConsumption;
use App\Domain\ValueObjects\HourlyMeasurement;
use App\Domain\ValueObjects\HourlyPrice;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;
use App\Domain\Exceptions\MissingHourlyPriceException;

final class HourlyMeasurementAssemblerTest extends TestCase
{
    private HourlyMeasurementAssembler $assembler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->assembler = new HourlyMeasurementAssembler();
    }

    public function test_it_assembles_hourly_measurements(): void
    {
        $date = CarbonImmutable::parse('2025-01-01');

        $consumptions = [
            new HourlyConsumption(
                date: $date,
                hour: 0,
                consumption: 10,
            ),
            new HourlyConsumption(
                date: $date,
                hour: 1,
                consumption: 20,
            ),
        ];

        $prices = [
            new HourlyPrice(
                date: $date,
                hour: 0,
                price: 0.10,
            ),
            new HourlyPrice(
                date: $date,
                hour: 1,
                price: 0.20,
            ),
        ];

        $measurements = $this->assembler->assemble(
            $consumptions,
            $prices,
        );

        $this->assertCount(2, $measurements);

        $this->assertContainsOnlyInstancesOf(
            HourlyMeasurement::class,
            $measurements,
        );

        $this->assertSame(10.0, $measurements[0]->consumption());
        $this->assertSame(0.10, $measurements[0]->omiePrice());

        $this->assertSame(20.0, $measurements[1]->consumption());
        $this->assertSame(0.20, $measurements[1]->omiePrice());
    }

    public function test_it_throws_an_exception_when_a_price_is_missing(): void
    {
        $date = CarbonImmutable::parse('2025-01-01');

        $consumptions = [
            new HourlyConsumption(
                date: $date,
                hour: 0,
                consumption: 10,
            ),
            new HourlyConsumption(
                date: $date,
                hour: 1,
                consumption: 20,
            ),
        ];

        $prices = [
            new HourlyPrice(
                date: $date,
                hour: 0,
                price: 0.10,
            ),
        ];

        $this->expectException(
            MissingHourlyPriceException::class,
        );

        $this->assembler->assemble(
            $consumptions,
            $prices,
        );
    }
}