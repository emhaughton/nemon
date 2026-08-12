<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\DTOs\ListPricesRequest as UseCaseRequest;
use App\Application\DTOs\Pagination;
use App\Application\UseCases\ListPricesUseCase;
use App\Domain\ValueObjects\DailyHourlyValues;
use App\Http\Requests\ListPricesRequest;
use Illuminate\Http\JsonResponse;

final class ListPricesController extends Controller
{
    public function __invoke(
        ListPricesRequest $request,
        ListPricesUseCase $useCase,
    ): JsonResponse {

        $response = $useCase->execute(
            new UseCaseRequest(
                pagination: new Pagination(
                    page: (int) $request->validated(
                        'page',
                        1,
                    ),
                    perPage: (int) $request->validated(
                        'perPage',
                        10,
                    ),
                ),
            ),
        );

        return response()->json([
            'data' => array_map(
                fn (DailyHourlyValues $item) => [
                    'date' => $item
                        ->date()
                        ->toDateString(),
                    ...collect(
                        $item->hourlyValues(),
                    )->mapWithKeys(
                        fn (float $value, int $hour) => [
                            "h{$hour}" => $value,
                        ],
                    )->all(),
                ],
                $response->result->items,
            ),
            'meta' => [
                'currentPage' => $response
                    ->result
                    ->currentPage,
                'perPage' => $response
                    ->result
                    ->perPage,
                'total' => $response
                    ->result
                    ->total,
                'lastPage' => $response
                    ->result
                    ->lastPage,
            ],
        ]);
    }
}