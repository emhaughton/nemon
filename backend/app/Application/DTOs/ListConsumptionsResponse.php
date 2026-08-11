<?php

declare(strict_types=1);

namespace App\Application\DTOs;

final readonly class ListConsumptionsResponse
{
    public function __construct(
        public PaginatedResult $result,
    ) {
    }
}