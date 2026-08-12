<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Consumption;
use App\Support\HourlyDataBuilder;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

final class ConsumptionSeeder extends Seeder
{
    private const TOTAL_DAYS = 50;

    public function run(): void
    {
        $start = CarbonImmutable::parse(
            '2025-01-01',
        );

        for ($day = 0; $day < self::TOTAL_DAYS; $day++) {

            $date = $start->addDays(
                $day,
            );

            Consumption::query()->create(
                HourlyDataBuilder::build(
                    $date,
                    fn (int $hour, CarbonImmutable $date): float => $this->hourlyConsumption(
                        $hour,
                        $date,
                    ),
                ),
            );
        }
    }

    private function hourlyConsumption(
        int $hour,
        CarbonImmutable $date,
    ): float {

        $seasonalFactor = $date->dayOfYear * 0.12;

        $hourFactor = match (true) {
            $hour <= 6 => 3.8,
            $hour <= 9 => 6.4,
            $hour <= 13 => 10.7,
            $hour <= 18 => 12.2,
            $hour <= 22 => 8.6,
            default => 5.1,
        };

        return round(
            $hourFactor + $seasonalFactor,
            4,
        );
    }
}