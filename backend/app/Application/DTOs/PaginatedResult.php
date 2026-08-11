<?php

declare(strict_types=1);

namespace App\Application\DTOs;

final readonly class PaginatedResult
{
    /**
     * @param array<object> $items
     */
    public function __construct(
        public array $items,
        public int $currentPage,
        public int $perPage,
        public int $total,
        public int $lastPage,
    ) {
    }
}