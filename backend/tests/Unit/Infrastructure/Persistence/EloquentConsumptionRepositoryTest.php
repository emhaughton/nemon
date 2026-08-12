<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Persistence;

use App\Domain\ValueObjects\HourlyConsumption;
use App\Infrastructure\Persistence\EloquentConsumptionRepository;
use App\Models\Consumption;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class EloquentConsumptionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_hourly_consumptions(): void
    {
        Consumption::factory()->create([
            'date' => '2025-01-01',
            'h1' => 10,
            'h2' => 20,
            'h25' => 0,
        ]);

        $repository = new EloquentConsumptionRepository();

        $result = $repository->between(
            CarbonImmutable::parse('2025-01-01'),
            CarbonImmutable::parse('2025-01-01'),
        );

        $this->assertCount(25, $result);

        $this->assertContainsOnlyInstancesOf(
            HourlyConsumption::class,
            $result,
        );

        $this->assertSame(10.0, $result[0]->consumption());
        $this->assertSame(20.0, $result[1]->consumption());
        $this->assertSame(0.0, $result[24]->consumption());
    }
}