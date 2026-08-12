<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\CreatesEnergyDataset;
use Tests\TestCase;

final class ListPricesControllerTest extends TestCase
{
    use RefreshDatabase;
    use CreatesEnergyDataset;

    public function test_it_lists_prices(): void
    {
        Price::query()->create(
            $this->buildDailyRow(
                '2025-01-01',
                [
                    1 => 100.50,
                    2 => 120.30,
                    25 => 50.00,
                ],
            ),
        );

        $response = $this->withHeaders(
            $this->apiHeaders()
        )->getJson(
            '/api/prices',
        );

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    [
                        'date',
                        'h1',
                        'h2',
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
                'h1' => 100.5,
                'h2' => 120.3,
                'h25' => 50.0,
            ]);
    }
}