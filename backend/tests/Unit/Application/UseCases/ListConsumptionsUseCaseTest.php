<?php

declare(strict_types=1);

namespace Tests\Unit\Application\UseCases;

use App\Application\DTOs\ListConsumptionsRequest;
use App\Application\DTOs\PaginatedResult;
use App\Application\DTOs\Pagination;
use App\Application\UseCases\ListConsumptionsUseCase;
use App\Domain\ValueObjects\DailyHourlyValues;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;
use Tests\Doubles\Fakes\FakeConsumptionRepository;

final class ListConsumptionsUseCaseTest extends TestCase
{
    public function test_it_returns_paginated_consumptions(): void
    {
        $repository = new FakeConsumptionRepository();

        $repository->paginatedResult = new PaginatedResult(
            items: [
                new DailyHourlyValues(
                    CarbonImmutable::parse('2025-01-01'),
                    [
                        1 => 10.5,
                        2 => 11.2,
                    ],
                ),
            ],
            currentPage: 1,
            perPage: 10,
            total: 1,
            lastPage: 1,
        );

        $useCase = new ListConsumptionsUseCase(
            $repository,
        );

        $response = $useCase->execute(
            new ListConsumptionsRequest(
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