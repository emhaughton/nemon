<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Application\DTOs\PaginatedResult;
use App\Application\DTOs\Pagination;
use App\Domain\Exceptions\MissingDateRangeException;
use App\Domain\ValueObjects\HourlyConsumption;
use Carbon\CarbonImmutable;

interface ConsumptionRepository
{
    /**
     * @throws MissingDateRangeException
     * 
     * @return HourlyConsumption[]
     */
    public function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): array;

    public function paginate(
        Pagination $pagination,
    ): PaginatedResult;
}