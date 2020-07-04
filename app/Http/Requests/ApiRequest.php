<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ApiRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        $erros = [
            "erros" => $validator->errors()
        ];
        throw new HttpResponseException(response()->json($erros, 400));
    }
}
