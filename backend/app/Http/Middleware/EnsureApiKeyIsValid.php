<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Responses\ErrorResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnsureApiKeyIsValid
{
    public function handle(
        Request $request,
        Closure $next,
    ): Response {

        if (
            empty($request->header('X-API-Key')) ||
            $request->header('X-API-Key')
            !== config('services.api.key')
        ) {
            return ErrorResponse::unauthorized();
        }

        return $next($request);
    }
}