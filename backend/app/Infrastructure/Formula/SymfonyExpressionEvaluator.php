<?php

declare(strict_types=1);

namespace App\Infrastructure\Formula;

use App\Domain\Contracts\ExpressionEvaluator;
use App\Domain\Exceptions\InvalidFormulaException;
use App\Domain\ValueObjects\Formula;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use App\Domain\Enums\FormulaPlaceholder;
use Throwable;

final readonly class SymfonyExpressionEvaluator implements ExpressionEvaluator
{
    public function __construct(
        private ExpressionLanguage $expressionLanguage = new ExpressionLanguage(),
    ) {
    }

    public function evaluate(
        Formula $formula,
        float $omieMd,
    ): float {

        $expression = str_replace(
            FormulaPlaceholder::OmieMd->placeholder(),
            FormulaPlaceholder::OmieMd->variable(),
            $formula->expression(),
        );
        try {

            return (float) $this->expressionLanguage->evaluate(
                $expression,
                [
                    FormulaPlaceholder::OmieMd->variable() => $omieMd,
                ],
            );


        } catch (Throwable $exception) {

            throw InvalidFormulaException::fromExpression(
                $formula->expression(),
                previous: $exception,
            );

        }
    }
}