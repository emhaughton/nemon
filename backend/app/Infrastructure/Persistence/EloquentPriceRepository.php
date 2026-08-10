<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Contracts\PriceRepository;
use App\Domain\ValueObjects\HourlyPrice;
use App\Models\Price;
use Carbon\CarbonImmutable;

final class EloquentPriceRepository implements PriceRepository
{
    /**
     * @return HourlyPrice[]
     */
    public function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): array {

        $rows = Price::query()
            ->whereBetween('date', [
                $from->toDateString(),
                $to->toDateString(),
            ])
            ->orderBy('date')
            ->get();

        $result = [];

        foreach ($rows as $row) {

            for ($hour = 1; $hour <= 25; $hour++) {

                $result[] = new HourlyPrice(
                    date: CarbonImmutable::parse($row->date),
                    hour: $hour,
                    price: (float) $row->{"h{$hour}"},
                );
            }
        }

        return $result;
    }
}