<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class StoreFonte extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "cod_interno" => "bail|required|unique:App\Models\Fonte,cod_interno|max:50",
            "cod_font" => "bail|unique:App\Models\Fonte,cod_font|required|max:50",
            "modelo" => "max:100",
            "fabricante" => "max:100"

        ];
    }

    public function messages()
    {
        return [
            'cod_interno.unique' => 'Esse código interno já existe no banco de dados',
            'cod_font.unique' => 'Esse código do fabricante já existe no banco de dados',
        ];
    }
}
