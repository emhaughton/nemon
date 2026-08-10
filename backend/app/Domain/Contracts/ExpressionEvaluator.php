<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\ValueObjects\Formula;

interface ExpressionEvaluator
{
    public function evaluate(
        Formula $formula,
        float $omieMd,
    ): float;
}