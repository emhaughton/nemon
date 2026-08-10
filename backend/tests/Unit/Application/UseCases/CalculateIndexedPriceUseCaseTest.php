<?php

declare(strict_types=1);

namespace Tests\Unit\Application\UseCases;

use App\Application\Assemblers\HourlyMeasurementAssembler;
use App\Application\DTOs\CalculateIndexedPriceRequest;
use App\Application\UseCases\CalculateIndexedPriceUseCase;
use App\Domain\Services\IndexedPriceCalculator;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;
use Tests\Doubles\Fakes\FakeConsumptionRepository;
use Tests\Doubles\Fakes\FakeExpressionEvaluator;
use Tests\Doubles\Fakes\FakePriceRepository;

final class CalculateIndexedPriceUseCaseTest extends TestCase
{
    public function test_it_calculates_the_indexed_price(): void
    {
        $useCase = new CalculateIndexedPriceUseCase(
            new FakeConsumptionRepository(),
            new FakePriceRepository(),
            new HourlyMeasurementAssembler(),
            new IndexedPriceCalculator(
                new FakeExpressionEvaluator(),
            ),
        );

        $response = $useCase->execute(
            new CalculateIndexedPriceRequest(
                from: CarbonImmutable::parse('2025-01-01'),
                to: CarbonImmutable::parse('2025-01-01'),
                formula: '([OMIE_MD] * 0.6) + 0.88',
            ),
        );

        $this->assertSame(
            2.0,
            $response->indexedPrice,
        );
    }
}