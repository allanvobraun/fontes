<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;
use App\Rules\ExistRelation;

class ReparosRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "cod_interno" => [
                "bail",
                "required",
                "exists:App\Models\Fonte,cod_interno",
                new ExistRelation,
                "max:50"
            ]
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
