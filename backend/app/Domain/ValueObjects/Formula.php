<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Domain\Exceptions\InvalidFormulaException;

final readonly class Formula
{
    public function __construct(
        private string $expression,
    ) {
        if (! str_contains($expression, '[OMIE_MD]')) {
            throw InvalidFormulaException::missingOmieMd();
        }
    }

    public function expression(): string
    {
        return $this->expression;
    }
}