<?php

declare(strict_types=1);

namespace App\Application\DTOs;

final readonly class ListPricesResponse
{
    public function __construct(
        public PaginatedResult $result,
    ) {
    }
}