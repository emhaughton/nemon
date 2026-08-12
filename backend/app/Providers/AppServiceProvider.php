<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Contracts\ConsumptionRepository;
use App\Domain\Contracts\ExpressionEvaluator;
use App\Domain\Contracts\PriceRepository;
use App\Infrastructure\Formula\SymfonyExpressionEvaluator;
use App\Infrastructure\Persistence\EloquentConsumptionRepository;
use App\Infrastructure\Persistence\EloquentPriceRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ConsumptionRepository::class,
            EloquentConsumptionRepository::class,
        );

        $this->app->bind(
            PriceRepository::class,
            EloquentPriceRepository::class,
        );

        $this->app->bind(
            ExpressionEvaluator::class,
            SymfonyExpressionEvaluator::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
