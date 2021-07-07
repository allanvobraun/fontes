<?php

namespace App\Http\Requests;


class SearchFonte extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'query' => 'max:50|required',
            'attribute' => 'in:cod_font,cod_interno,modelo,fabricante|required'
        ];
    }
}
