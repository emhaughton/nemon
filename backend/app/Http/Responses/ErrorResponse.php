<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

final readonly class ErrorResponse
{
    public static function badRequest(string $message = "Invalid or incomplete request data."): JsonResponse
    {
        return response()->json(
            [
                'message' => $message,
            ],
            400,
        );
    }

    public static function notFound(): JsonResponse
    {
        return response()->json(
            [
                'message' => 'No consumption or price data found for the requested date range.',
            ],
            404,
        );
    }

    public static function internalServerError(): JsonResponse
    {
        return response()->json(
            [
                'message' => 'An unexpected error occurred while processing the calculation.',
            ],
            500,
        );
    }
}