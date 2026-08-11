<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Application\DTOs\PaginatedResult;
use App\Application\DTOs\Pagination;
use App\Domain\ValueObjects\DailyHourlyValues;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentHourlyRepository
{
    /**
     * @return class-string<Model>
     */
    abstract protected function modelClass(): string;

    protected function paginateModel(
        Pagination $pagination,
    ): PaginatedResult {

        $model = $this->modelClass();

        $paginator = $model::query()
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