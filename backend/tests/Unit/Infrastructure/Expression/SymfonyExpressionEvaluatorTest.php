<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Expression;

use App\Domain\Exceptions\InvalidFormulaException;
use App\Domain\ValueObjects\Formula;
use App\Infrastructure\Formula\SymfonyExpressionEvaluator;
use PHPUnit\Framework\TestCase;

final class SymfonyExpressionEvaluatorTest extends TestCase
{
    public function test_it_evaluates_a_formula(): void
    {
        $formula = new Formula(
            '([OMIE_MD] * 0.6) + 0.88',
        );

        $evaluator = new SymfonyExpressionEvaluator();

        $result = $evaluator->evaluate(
            $formula,
            0.1325,
        );

        $this->assertEqualsWithDelta(
            0.9595,
            $result,
            0.00001,
        );
    }

    public function test_it_throws_exception_for_invalid_formula(): void
    {
        $this->expectException(
            InvalidFormulaException::class,
        );

        $formula = new Formula(
            '([OMIE_MD] *',
        );

        $evaluator = new SymfonyExpressionEvaluator();

        $evaluator->evaluate(
            $formula,
            0.1325,
        );
    }
}