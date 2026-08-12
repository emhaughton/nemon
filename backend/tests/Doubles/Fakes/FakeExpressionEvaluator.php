<?php

declare(strict_types=1);

namespace Tests\Doubles\Fakes;

use App\Domain\Contracts\ExpressionEvaluator;
use App\Domain\ValueObjects\Formula;

final class FakeExpressionEvaluator implements ExpressionEvaluator
{
    public function evaluate(
        Formula $formula,
        float $marketPrice,
    ): float {
        return 2.0;
    }
}