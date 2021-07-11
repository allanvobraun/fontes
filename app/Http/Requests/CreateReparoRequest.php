<?php

namespace App\Http\Requests;

class CreateReparoRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id" => 'bail|exists:App\Models\Fonte,id|required|max:50|',
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
            'cod_font.exists' => 'O código da fonte não existe',
        ];
    }
}
