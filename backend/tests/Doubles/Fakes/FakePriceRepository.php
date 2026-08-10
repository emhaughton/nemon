<?php

declare(strict_types=1);

namespace Tests\Doubles\Fakes;

use App\Domain\Contracts\PriceRepository;
use App\Domain\ValueObjects\HourlyPrice;
use Carbon\CarbonImmutable;

final class FakePriceRepository implements PriceRepository
{
    /**
     * @return HourlyPrice[]
     */
    public function between(
        CarbonImmutable $from,
        CarbonImmutable $to,
    ): array {

        $prices = [
            new HourlyPrice(
                date: CarbonImmutable::parse('2025-01-01'),
                hour: 0,
                price: 0.10,
            ),
            new HourlyPrice(
                date: CarbonImmutable::parse('2025-01-01'),
                hour: 1,
                price: 0.20,
            ),
            new HourlyPrice(
                date: CarbonImmutable::parse('2025-01-02'),
                hour: 0,
                price: 0.30,
            ),
        ];

        return array_values(array_filter(
            $prices,
            static fn (HourlyPrice $price): bool =>
                $price->date()->betweenIncluded($from, $to),
        ));
    }
}