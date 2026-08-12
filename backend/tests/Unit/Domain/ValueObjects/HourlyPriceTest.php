<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\HourlyPrice;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;

final class HourlyPriceTest extends TestCase
{
    public function test_it_stores_hourly_price(): void
{
    $date = CarbonImmutable::parse('2025-01-01');

    $price = new HourlyPrice(
        $date,
        8,
        0.123,
    );

    $this->assertSame($date, $price->date());
    $this->assertSame(8, $price->hour());
    $this->assertSame(0.123, $price->price());
}
}