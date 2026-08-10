<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Price;
use App\Support\HourlyDataBuilder;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

final class PriceSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Coincide con Consumption
        |--------------------------------------------------------------------------
        */

        $this->createRange(
            CarbonImmutable::parse('2025-01-01'),
            10,
        );

        /*
        |--------------------------------------------------------------------------
        | Del 11 al 20 NO existen precios.
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Del 21 al 40 existen precios sin consumo.
        |--------------------------------------------------------------------------
        */

        $this->createRange(
            CarbonImmutable::parse('2025-01-21'),
            20,
        );

        /*
        |--------------------------------------------------------------------------
        | Del 10 al 19 de febrero vuelven a coincidir.
        |--------------------------------------------------------------------------
        */

        $this->createRange(
            CarbonImmutable::parse('2025-02-10'),
            10,
        );
    }

    private function createRange(
        CarbonImmutable $startDate,
        int $days,
    ): void {

        for ($day = 0; $day < $days; $day++) {

            $date = $startDate->addDays(
                $day,
            );

            Price::query()->create(
                HourlyDataBuilder::build(
                    $date,
                    fn (int $hour, CarbonImmutable $date): float => $this->hourlyPrice(
                        $hour,
                        $date,
                    ),
                ),
            );
        }
    }

    private function hourlyPrice(
        int $hour,
        CarbonImmutable $date,
    ): float {

        $dailyVariation = $date->dayOfYear * 0.00045;

        $hourFactor = match (true) {
            $hour <= 6 => 0.075,
            $hour <= 9 => 0.098,
            $hour <= 13 => 0.132,
            $hour <= 18 => 0.165,
            $hour <= 22 => 0.118,
            default => 0.087,
        };

        return round(
            $hourFactor + $dailyVariation,
            6,
        );
    }
}