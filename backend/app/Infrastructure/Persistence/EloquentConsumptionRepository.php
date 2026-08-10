<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Contracts\ConsumptionRepository;
use App\Domain\Exceptions\MissingDateRangeException;
use App\Domain\ValueObjects\HourlyConsumption;
use App\Models\Consumption;
use Carbon\CarbonImmutable;

final class EloquentConsumptionRepository implements ConsumptionRepository
{
    /**
     * @return HourlyConsumption[]
     *
     * @throws MissingDateRangeException
     */
    public function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): array {

        $rows = Consumption::query()
            ->whereBetween('date', [
                $from->toDateString(),
                $to->toDateString(),
            ])
            ->orderBy('date')
            ->get();

        $expectedDays = $from->diffInDays($to) + 1;

        if ($rows->count() !== $expectedDays) {
            throw MissingDateRangeException::between(
                $from,
                $to,
            );
        }

        $result = [];

        foreach ($rows as $row) {

            for ($hour = 1; $hour <= 25; $hour++) {

                $result[] = new HourlyConsumption(
                    date: CarbonImmutable::parse($row->date),
                    hour: $hour,
                    consumption: (float) $row->{"h{$hour}"},
                );
            }
        }

        return $result;
    }
}