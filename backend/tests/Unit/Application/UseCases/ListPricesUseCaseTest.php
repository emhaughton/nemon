<?php

declare(strict_types=1);

namespace Tests\Unit\Application\UseCases;

use App\Application\DTOs\ListPricesRequest;
use App\Application\DTOs\PaginatedResult;
use App\Application\DTOs\Pagination;
use App\Application\UseCases\ListPricesUseCase;
use App\Domain\ValueObjects\DailyHourlyValues;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;
use Tests\Doubles\Fakes\FakePriceRepository;

final class ListPricesUseCaseTest extends TestCase
{
    public function test_it_returns_paginated_prices(): void
    {
        $repository = new FakePriceRepository();

        $repository->paginatedResult = new PaginatedResult(
            items: [
                new DailyHourlyValues(
                    CarbonImmutable::parse('2025-01-01'),
                    [
                        1 => 100.50,
                        2 => 120.30,
                    ],
                ),
            ],
            currentPage: 1,
            perPage: 10,
            total: 1,
            lastPage: 1,
        );

        $useCase = new ListPricesUseCase(
            $repository,
        );

        $response = $useCase->execute(
            new ListPricesRequest(
                new Pagination(
                    1,
                    10,
                ),
            ),
        );

        $this->assertSame(
            1,
            $response->result->total,
        );
    }
}