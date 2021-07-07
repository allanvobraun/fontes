<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReparoResource as ReparoResource;

class FonteResource extends JsonResource
{
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
