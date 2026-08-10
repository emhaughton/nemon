<?php

declare(strict_types=1);

namespace App\Application\Assemblers;

use App\Domain\Exceptions\MissingHourlyPriceException;
use App\Domain\ValueObjects\HourlyConsumption;
use App\Domain\ValueObjects\HourlyMeasurement;
use App\Domain\ValueObjects\HourlyPrice;

final class HourlyMeasurementAssembler
{
    /**
     * @param HourlyConsumption[] $consumptions
     * @param HourlyPrice[] $prices
     *
     * @return HourlyMeasurement[]
     */
    public function assemble(
        array $consumptions,
        array $prices,
    ): array {

        $indexedPrices = [];

        foreach ($prices as $price) {

            $indexedPrices[
                $price->date()->format('Y-m-d') . '-' . $price->hour()
            ] = $price;
        }

        $measurements = [];

        foreach ($consumptions as $consumption) {

            $key = $consumption->date()->format('Y-m-d')
                . '-'
                . $consumption->hour();

            if (! isset($indexedPrices[$key])) {
                throw MissingHourlyPriceException::forHour(
                    $consumption->date(),
                    $consumption->hour(),
                );
            }

            $price = $indexedPrices[$key];

            $measurements[] = new HourlyMeasurement(
                date: $consumption->date(),
                hour: $consumption->hour(),
                consumption: $consumption->consumption(),
                omiePrice: $price->price(),
            );
        }

        return $measurements;
    }
}