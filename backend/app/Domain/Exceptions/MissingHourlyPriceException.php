<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use Carbon\CarbonImmutable;
use RuntimeException;

final class MissingHourlyPriceException extends RuntimeException
{
    public static function forHour(
        CarbonImmutable $date,
        int $hour,
    ): self {
        return new self(
            sprintf(
                'Missing OMIE price for %s hour %d.',
                $date->toDateString(),
                $hour,
            ),
        );
    }
}