<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use RuntimeException;
use Throwable;

final class InvalidFormulaException extends RuntimeException
{
    public static function fromExpression(
        string $expression,
        ?Throwable $previous = null,
    ): self {

        return new self(
            sprintf(
                'Invalid formula: %s',
                $expression,
            ),
            previous: $previous,
        );
    }

    public static function missingOmieMd(): self
    {
        return new self(
            'The formula must contain the [OMIE_MD] placeholder.',
        );
    }
}