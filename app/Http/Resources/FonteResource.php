<?php

namespace App\Http\Resources;

use App\Http\Resources\ReparoResource as ReparoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FonteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cod_interno' => $this->cod_interno,
            'cod_font' => $this->cod_font,
            'modelo' => $this->modelo,
            'fabricante' => $this->fabricante,
            'reparos' => ReparoResource::collection($this->whenLoaded('reparos'))
        ];
    }
}
