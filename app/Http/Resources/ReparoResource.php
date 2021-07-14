<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReparoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fonte_id' => $this->fonte_id,
            'desc_problema' => $this->desc_problema,
            'peças' => $this->peças,
            'status' => $this->status,
            'valor' => $this->valor,
            'data' => $this->data,
        ];
    }
}
