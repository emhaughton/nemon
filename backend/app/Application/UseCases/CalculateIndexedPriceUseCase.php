<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\Assemblers\HourlyMeasurementAssembler;
use App\Application\DTOs\CalculateIndexedPriceRequest;
use App\Application\DTOs\CalculateIndexedPriceResponse;
use App\Domain\Contracts\ConsumptionRepository;
use App\Domain\Contracts\PriceRepository;
use App\Domain\Services\IndexedPriceCalculator;
use App\Domain\ValueObjects\Formula;

final readonly class CalculateIndexedPriceUseCase
{
    public function __construct(
        private ConsumptionRepository $consumptionRepository,
        private PriceRepository $priceRepository,
        private HourlyMeasurementAssembler $assembler,
        private IndexedPriceCalculator $calculator,
    ) {
    }

    public function execute(
        CalculateIndexedPriceRequest $request,
    ): CalculateIndexedPriceResponse {

        $consumptions = $this->consumptionRepository->between(
            $request->from,
            $request->to,
        );

        $prices = $this->priceRepository->between(
            $request->from,
            $request->to,
        );

        $measurements = $this->assembler->assemble(
            $consumptions,
            $prices,
        );

        $indexedPrice = $this->calculator->calculate(
            new Formula($request->formula),
            $measurements,
        );

        return new CalculateIndexedPriceResponse(
            $indexedPrice->value(),
        );
    }
}