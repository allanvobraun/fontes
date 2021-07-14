<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class FonteRequest extends ApiRequest
{
    protected string $errorMassage = 'Erro ao salvar a fonte';

    public function rules()
    {
        return [
            "cod_interno" => ['bail', 'required', 'max:50', Rule::unique('fontes')->ignore($this->id)],
            "cod_font" => ['bail', 'required', 'max:50', Rule::unique('fontes')->ignore($this->id)],
            "modelo" => "max:100",
            "fabricante" => "max:100"
        ];
    }

    public function validationData()
    {
        return $this->only(['cod_interno', 'cod_font', 'modelo', 'fabricante']);
    }

    public function messages()
    {
        return [
            'cod_interno.unique' => 'Esse código interno já existe no banco de dados',
            'cod_font.unique' => 'Esse código do fabricante já existe no banco de dados',
        ];
    }

    public function attributes()
    {
        return [
            'cod_interno' => 'N/S Rework',
            'cod_font' => 'N/S Fabricante',
        ];
    }
}
