<?php

declare(strict_types=1);

use App\Domain\Exceptions\InvalidFormulaException;
use App\Domain\Exceptions\MissingDateRangeException;
use App\Domain\Exceptions\MissingHourlyPriceException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request): bool => $request->is('api/*'),
        );

        $exceptions->render(function (
            InvalidFormulaException $exception,
            Request $request,
        ): ?JsonResponse {

            if (! $request->is('api/*')) {
                return null;
            }

            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        });

        $exceptions->render(function (
            MissingDateRangeException $exception,
            Request $request,
        ): ?JsonResponse {

            if (! $request->is('api/*')) {
                return null;
            }

            return response()->json([
                'message' => $exception->getMessage(),
            ], 404);
        });

        $exceptions->render(function (
            MissingHourlyPriceException $exception,
            Request $request,
        ): ?JsonResponse {

            if (! $request->is('api/*')) {
                return null;
            }

            return response()->json([
                'message' => $exception->getMessage(),
            ], 404);
        });

    })
    ->create();