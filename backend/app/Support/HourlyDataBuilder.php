<?php

declare(strict_types=1);

namespace App\Support;

use Carbon\CarbonImmutable;
use Closure;

final class HourlyDataBuilder
{
    private const HOURS_PER_DAY = 25;

    /**
     * @param Closure(int, CarbonImmutable): float $valueResolver
     *
     * @return array<string, mixed>
     */
    public static function build(
        CarbonImmutable $date,
        Closure $valueResolver,
    ): array {
        $row = [
            'date' => $date->toDateString(),
        ];

        for ($hour = 1; $hour <= self::HOURS_PER_DAY; $hour++) {
            $row["h{$hour}"] = $valueResolver(
                $hour,
                $date,
            );
        }

        return $row;
    }
}