<?php

namespace App\Http\Requests;

class ReparoRequest extends ApiRequest
{
    public function rules()
    {
        return [
            "fonteId" => 'bail|exists:App\Models\Fonte,id|required|max:50|',
            "desc_problema" => 'max:100',
            "peças" => 'max:100',
            "valor" => 'numeric',
            "status" => 'in:OK,NOK|required|max:3'
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }

    public function messages()
    {
        return [
            'fonteId.exists' => 'O código da fonte não existe',
        ];
    }
}
