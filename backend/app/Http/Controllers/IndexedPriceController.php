<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\DTOs\CalculateIndexedPriceRequest as UseCaseRequest;
use App\Application\UseCases\CalculateIndexedPriceUseCase;
use App\Domain\ValueObjects\Formula;
use App\Http\Requests\CalculateIndexedPriceRequest;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;

final class IndexedPriceController extends Controller
{
    public function __invoke(
        CalculateIndexedPriceRequest $request,
        CalculateIndexedPriceUseCase $useCase,
    ): JsonResponse {

        $response = $useCase->execute(
            new UseCaseRequest(
                from: CarbonImmutable::parse(
                    $request->validated('from'),
                ),
                to: CarbonImmutable::parse(
                    $request->validated('to'),
                ),
                formula: new Formula(
                    $request->validated('formula'),
                ),
            ),
        );

        return response()->json([
            'indexedPrice' => $response
                ->indexedPrice
                ->value(),
        ]);
    }
}