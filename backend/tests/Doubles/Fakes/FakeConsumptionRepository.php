<?php

declare(strict_types=1);

namespace Tests\Doubles\Fakes;

use App\Domain\Contracts\ConsumptionRepository;
use App\Domain\ValueObjects\HourlyConsumption;
use Carbon\CarbonImmutable;

final class FakeConsumptionRepository implements ConsumptionRepository
{
    /**
     * @return HourlyConsumption[]
     */
    public function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): array {

        $measurements = [
            new HourlyConsumption(
                date: CarbonImmutable::parse('2025-01-01'),
                hour: 0,
                consumption: 10.0,
            ),
            new HourlyConsumption(
                date: CarbonImmutable::parse('2025-01-01'),
                hour: 1,
                consumption: 20.0,
            ),
            new HourlyConsumption(
                date: CarbonImmutable::parse('2025-01-02'),
                hour: 0,
                consumption: 30.0,
            ),
        ];

        return array_values(array_filter(
            $measurements,
            static fn (HourlyConsumption $measurement): bool =>
                $measurement->date()->betweenIncluded($from, $to),
        ));
    }
}