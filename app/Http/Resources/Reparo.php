<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Reparo extends JsonResource
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
            'desc_problema' => $this->desc_problema,
            'peças' => $this->peças,
            'status' => $this->status,
            'data' => $this->created_at
        ];
    }
}
