<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function apiHeaders(): array
    {
        return [
            'X-API-Key' => config('services.api.key'),
        ];
    }
}
