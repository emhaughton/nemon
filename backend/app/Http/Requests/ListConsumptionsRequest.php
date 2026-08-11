<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ListConsumptionsRequest extends ApiRequest
{

    public function rules(): array
    {
        return [
            'page' => [
                'sometimes',
                'integer',
                'min:1',
            ],
            'perPage' => [
                'sometimes',
                'integer',
                'min:1',
                'max:100',
            ],
        ];
    }
}