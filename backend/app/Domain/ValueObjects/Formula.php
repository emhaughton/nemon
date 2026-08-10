<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

final readonly class Formula
{
    public function __construct(
        private string $expression,
    ) {
    }

    public function expression(): string
    {
        return $this->expression;
    }
}