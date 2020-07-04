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
            "cod_font" => "bail|required|unique:App\Models\Fonte,cod_font|max:50",
            "cod_interno" => "bail|unique:App\Models\Fonte,cod_interno|required|max:50",
            "modelo" => "max:100",
            "fabricante" => "max:100"

        ];
    }

    public function messages()
    {
        return [
            'cod_font.unique' => 'A fonte já existe no banco de dados',
        ];
    }
}
