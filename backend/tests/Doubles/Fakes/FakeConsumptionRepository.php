<?php

declare(strict_types=1);

namespace Tests\Doubles\Fakes;

use App\Application\DTOs\PaginatedResult;
use App\Application\DTOs\Pagination;
use App\Domain\Contracts\ConsumptionRepository;
use App\Domain\ValueObjects\HourlyConsumption;
use Carbon\CarbonImmutable;

final class FakeConsumptionRepository implements ConsumptionRepository
{

    public PaginatedResult $paginatedResult;     

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

    public function paginate(
        Pagination $pagination,
    ): PaginatedResult {
        return $this->paginatedResult;
    }
}