<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

final class CalculateIndexedPriceControllerTest extends TestCase
{
    public function test_it_validates_the_request(): void
    {
        $response = $this->postJson(
            '/api/indexed-price',
            [],
        );

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'from',
                'to',
                'formula',
            ]);
    }
}