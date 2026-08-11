<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Application\DTOs\PaginatedResult;
use App\Application\DTOs\Pagination;
use App\Domain\Contracts\ConsumptionRepository;
use App\Domain\Exceptions\MissingDateRangeException;
use App\Domain\ValueObjects\HourlyConsumption;
use App\Models\Consumption;
use Carbon\CarbonImmutable;


final class EloquentConsumptionRepository extends AbstractEloquentHourlyRepository implements ConsumptionRepository
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

        return $this->paginateModel(
            $pagination,
        );
    }

    /**
     * @return class-string<Consumption>
     */
    protected function modelClass(): string
    {
        return Consumption::class;
    }
}