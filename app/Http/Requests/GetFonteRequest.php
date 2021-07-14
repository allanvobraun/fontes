<?php

namespace App\Http\Requests;


class GetFonteRequest extends ApiRequest
{
    public function rules()
    {
        return [
            "cod_interno" => "bail|required|exists:App\Models\Fonte,cod_interno|max:50"
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }

    public function messages()
    {
        return [
            'cod_interno.exists' => 'Essa fonte não existe no banco de dados',
        ];
    }
}
