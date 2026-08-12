<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Consumption;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ConsumptionFactory extends Factory
{
    protected $model = Consumption::class;

    public function definition(): array
    {
        $attributes = [
            'date' => now()->toDateString(),
        ];

        for ($hour = 1; $hour <= 25; $hour++) {
            $attributes["h{$hour}"] = fake()->randomFloat(
                4,
                0,
                100,
            );
        }

        return $attributes;
    }
}