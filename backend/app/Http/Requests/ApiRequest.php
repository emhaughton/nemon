<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Responses\ErrorResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(
        Validator $validator,
    ): void {

        throw new HttpResponseException(
            ErrorResponse::badRequest(),
        );
    }
}