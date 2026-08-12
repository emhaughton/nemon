<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Models\Consumption;
use App\Models\Price;

trait CreatesEnergyDataset
{
    private const HOURS_PER_DAY = 25;
    
    /**
     * @param array<int, float|int> $hourlyValues
     */
    protected function createConsumptionDay(
        string $date,
        array $hourlyValues,
    ): void {
        Consumption::query()->create(
            $this->buildDailyRow(
                $date,
                $hourlyValues,
            ),
        );
    }

    /**
     * @param array<int, float|int> $hourlyValues
     */
    protected function createPriceDay(
        string $date,
        array $hourlyValues,
    ): void {
        Price::query()->create(
            $this->buildDailyRow(
                $date,
                $hourlyValues,
            ),
        );
    }

    /**
     * @param array<int, float|int> $hourlyValues
     *
     * @return array<string, mixed>
     */
    private function buildDailyRow(
        string $date,
        array $hourlyValues,
    ): array {
        $row = [
            'date' => $date,
        ];

        for ($hour = 1; $hour <= self::HOURS_PER_DAY; $hour++) {
            $row["h{$hour}"] = 0;
        }

        foreach ($hourlyValues as $hour => $value) {
            $row["h{$hour}"] = $value;
        }

        return $row;
    }
}