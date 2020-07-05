<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class SearchOneFonte extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "cod_font" => "bail|required|exists:App\Models\Fonte,cod_font|max:50"
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
