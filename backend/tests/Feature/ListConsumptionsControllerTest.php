<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Consumption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\CreatesEnergyDataset;
use Tests\TestCase;

final class ListConsumptionsControllerTest extends TestCase
{
    use RefreshDatabase;
    use CreatesEnergyDataset;

    public function test_it_lists_consumptions(): void
    {
        Consumption::query()->create(
            $this->buildDailyRow(
                '2025-01-01',
                [
                    1 => 10,
                    2 => 20,
                    25 => 0,
                ],
            ),
        );

        $response = $this->withHeaders(
            $this->apiHeaders()
        )->getJson(
            '/api/consumptions',
        );

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    [
                        'date',
                        'h1',
                        'h25',
                    ],
                ],
                'meta' => [
                    'currentPage',
                    'perPage',
                    'total',
                    'lastPage',
                ],
            ])    
            ->assertJsonFragment([
                'date' => '2025-01-01',
                'h1' => 10.0,
                'h2' => 20.0,
                'h25' => 0.0,
            ]);
    }
}