<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\DTOs\ListPricesRequest;
use App\Application\DTOs\ListPricesResponse;
use App\Domain\Contracts\PriceRepository;

final readonly class ListPricesUseCase
{
    public function __construct(
        private PriceRepository $repository,
    ) {
    }

    public function execute(
        ListPricesRequest $request,
    ): ListPricesResponse {

        return new ListPricesResponse(
            $this->repository->paginate(
                $request->pagination,
            ),
        );
    }
}