<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\CreatesEnergyDataset;
use Tests\TestCase;

final class CalculateIndexedPriceControllerTest extends TestCase
{
    use RefreshDatabase;
    use CreatesEnergyDataset;

    public function test_it_requires_all_fields(): void
    {
        $response = $this->postJson(
            '/api/indexed-price',
            [],
        );

        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Invalid or incomplete request data.',
            ]);
    }

    public function test_it_calculates_the_indexed_price(): void
    {
        $this->createConsumptionDay(
            '2025-01-01',
            [
                1 => 10,
                2 => 20,
            ],
        );

        $this->createPriceDay(
            '2025-01-01',
            [
                1 => 0.10,
                2 => 0.20,
            ],
        );

        $response = $this->postJson(
            '/api/indexed-price',
            [
                'from' => '2025-01-01',
                'to' => '2025-01-01',
                'formula' => '([OMIE_MD] * 0.6) + 0.88',
            ],
        );

        $response
            ->assertOk()
            ->assertJson([
                'price_indexed' => 0.98,
            ]);
    }

    public function test_it_returns_not_found_when_data_is_missing(): void
    {
        $response = $this->postJson(
            '/api/indexed-price',
            [
                'from' => '2025-01-01',
                'to' => '2025-01-01',
                'formula' => '([OMIE_MD] * 0.6) + 0.88',
            ],
        );

        $response->assertStatus(404);
    }

    public function test_it_returns_bad_request_when_formula_is_invalid(): void
    {
        $this->createConsumptionDay(
            '2025-01-01',
            [
                1 => 10,
            ],
        );

        $this->createPriceDay(
            '2025-01-01',
            [
                1 => 0.10,
            ],
        );

        $response = $this->postJson(
            '/api/indexed-price',
            [
                'from' => '2025-01-01',
                'to' => '2025-01-01',
                'formula' => '([OMIE_MD] *',
            ],
        );

        $response->assertStatus(400);
    }
}