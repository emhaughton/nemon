<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Contracts\ExpressionEvaluator;
use App\Domain\ValueObjects\Formula;
use App\Domain\ValueObjects\HourlyMeasurement;
use App\Domain\ValueObjects\IndexedPrice;

final readonly class IndexedPriceCalculator
{
    public function __construct(
        private ExpressionEvaluator $expressionEvaluator,
    ) {
    }

    /**
     * @param HourlyMeasurement[] $measurements
     */
    public function calculate(
        Formula $formula,
        array $measurements,
    ): IndexedPrice {

        $totalConsumption = 0.0;
        $totalAmount = 0.0;

        foreach ($measurements as $measurement) {

            $indexedPrice = $this->expressionEvaluator->evaluate(
                $formula,
                $measurement->omiePrice(),
            );

            $totalAmount +=
                $indexedPrice * $measurement->consumption();

            $totalConsumption +=
                $measurement->consumption();
        }

        return new IndexedPrice(
            $totalAmount / $totalConsumption,
        );
    }
}