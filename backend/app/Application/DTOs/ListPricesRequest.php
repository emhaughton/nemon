<?php

declare(strict_types=1);

namespace App\Application\DTOs;

final readonly class ListPricesRequest
{
    public function __construct(
        public Pagination $pagination,
    ) {
    }
}