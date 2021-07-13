<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ApiRequest extends FormRequest
{
    protected string $errorMassage = '';

    public function failedValidation(Validator $validator)
    {
        $response = [
            'message' => $this->errorMassage,
            "erros" => $validator->errors(),
        ];
        throw new HttpResponseException(response()->json($response, 400));
    }
}
