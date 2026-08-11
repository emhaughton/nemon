<?php

declare(strict_types=1);

namespace App\Application\DTOs;

final readonly class ListConsumptionsRequest
{
    public function __construct(
        public Pagination $pagination,
    ) {
    }
}