<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Application\DTOs\PaginatedResult;
use App\Application\DTOs\Pagination;
use App\Domain\Contracts\ConsumptionRepository;
use App\Domain\Exceptions\MissingDateRangeException;
use App\Domain\ValueObjects\DailyHourlyValues;
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
            ->whereDate(
                'date',
                '>=',
                $from,
            )
            ->whereDate(
                'date',
                '<=',
                $to,
            )
            ->orderBy('date')
            ->get();

        $expectedDays = (int) ($from->diffInDays($to) + 1);

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
                    date: CarbonImmutable::instance($row->date),
                    hour: $hour,
                    consumption: (float) $row->{"h{$hour}"},
                );
            }
        }

        return $result;
    }

    public function paginate(
        Pagination $pagination,
    ): PaginatedResult {

        $paginator = Consumption::query()
            ->orderBy('date')
            ->paginate(
                $pagination->perPage,
                ['*'],
                'page',
                $pagination->page,
            );

        $items = [];

        foreach ($paginator->items() as $row) {

            $hourlyValues = [];

            for ($hour = 1; $hour <= 25; $hour++) {
                $hourlyValues[$hour] = (float) $row->{"h{$hour}"};
            }

            $items[] = new DailyHourlyValues(
                date: CarbonImmutable::instance(
                    $row->date,
                ),
                hourlyValues: $hourlyValues,
            );
        }

        return new PaginatedResult(
            items: $items,
            currentPage: $paginator->currentPage(),
            perPage: $paginator->perPage(),
            total: $paginator->total(),
            lastPage: $paginator->lastPage(),
        );
    }
}