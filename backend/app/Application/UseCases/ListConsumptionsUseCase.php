<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\DTOs\ListConsumptionsRequest;
use App\Application\DTOs\ListConsumptionsResponse;
use App\Domain\Contracts\ConsumptionRepository;

final readonly class ListConsumptionsUseCase
{
    public function __construct(
        private ConsumptionRepository $repository,
    ) {
    }

    public function execute(
        ListConsumptionsRequest $request,
    ): ListConsumptionsResponse {

        return new ListConsumptionsResponse(
            $this->repository->paginate(
                $request->pagination,
            ),
        );
    }
}