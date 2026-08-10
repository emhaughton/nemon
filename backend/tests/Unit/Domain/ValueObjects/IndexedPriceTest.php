<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\IndexedPrice;
use PHPUnit\Framework\TestCase;

final class IndexedPriceTest extends TestCase
{
    public function test_it_stores_the_value(): void
    {
        $price = new IndexedPrice(0.956);

        $this->assertSame(
            0.956,
            $price->value(),
        );
    }
}