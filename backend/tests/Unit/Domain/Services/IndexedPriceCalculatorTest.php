<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Services;

use App\Domain\Services\IndexedPriceCalculator;
use App\Domain\ValueObjects\Formula;
use App\Domain\ValueObjects\HourlyMeasurement;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;
use Tests\Doubles\Fakes\FakeExpressionEvaluator;

final class IndexedPriceCalculatorTest extends TestCase
{
    public function test_it_calculates_indexed_price(): void
    {
        $calculator = new IndexedPriceCalculator(
            new FakeExpressionEvaluator(),
        );

        $formula = new Formula(
            '([OMIE_MD] * 0.6) + 0.88',
        );

        $measurements = [

            new HourlyMeasurement(
                CarbonImmutable::parse('2025-01-01'),
                0,
                10,
                0.15,
            ),

            new HourlyMeasurement(
                CarbonImmutable::parse('2025-01-01'),
                1,
                20,
                0.16,
            ),

        ];

        $result = $calculator->calculate(
            $formula,
            $measurements,
        );

        $this->assertSame(
            2.0,
            $result->value(),
        );
    }
}