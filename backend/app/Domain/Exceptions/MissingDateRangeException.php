<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use Carbon\CarbonImmutable;
use RuntimeException;

final class MissingDateRangeException extends RuntimeException
{
    public static function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): self {
        return new self(
            sprintf(
                'Missing data for the requested date range: %s - %s.',
                $from->toDateString(),
                $to->toDateString(),
            ),
        );
    }
}