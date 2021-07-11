<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;
use App\Rules\ExistRelation;

class RelationReparoRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "fonteId" => [new ExistRelation, 'exists:App\Models\Fonte,id'],
        ];
    }
    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }

    public function messages()
    {
        return [
            'id.exists' => 'Essa fonte não existe no banco de dados',
        ];
    }
}
