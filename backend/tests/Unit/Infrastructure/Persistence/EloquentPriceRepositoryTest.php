<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Persistence;

use App\Domain\ValueObjects\HourlyPrice;
use App\Infrastructure\Persistence\EloquentPriceRepository;
use App\Models\Price;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class EloquentPriceRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_hourly_prices(): void
    {
        Price::factory()->create([
            'date' => '2025-01-01',
            'h1' => 10,
            'h2' => 20,
            'h25' => 0,
        ]);

        $repository = new EloquentPriceRepository();

        $result = $repository->between(
            CarbonImmutable::parse('2025-01-01'),
            CarbonImmutable::parse('2025-01-01'),
        );

        $this->assertCount(25, $result);

        $this->assertContainsOnlyInstancesOf(
            HourlyPrice::class,
            $result,
        );

        $this->assertSame(10.0, $result[0]->price());
        $this->assertSame(20.0, $result[1]->price());
        $this->assertSame(0.0, $result[24]->price());
    }
}