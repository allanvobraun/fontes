<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Reparo as ReparoResource;

class Fonte extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'cod_interno' => $this->cod_interno,
            'cod_font' => $this->cod_font,
            'modelo' => $this->modelo,
            'fabricante' => $this->fabricante
        ];
    }
}

// {
//     id: 1,
//     cod_interno: "codduwia2",
//     cod_font: "duhxauwghd",
//     desc_problema: "queimado",
//     peças: "parafusoaa30",
//     status: "ok",
//     created_at: "2020-06-30 18:25:23",
//     updated_at: "2020-06-30 18:25:25",
//     modelo: "modelo213",
//     fabricante: "fabricante2321"
//   }