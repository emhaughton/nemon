<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

final class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition(): array
    {
        $attributes = [
            'date' => now()->toDateString(),
        ];

        for ($hour = 1; $hour <= 25; $hour++) {
            $attributes["h{$hour}"] = fake()->randomFloat(
                6,
                0,
                1,
            );
        }

        return $attributes;
    }
}