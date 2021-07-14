<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReparoResource;

class ReparoResourceNotNull extends ReparoResource
{
    public function toArray($request)
    {
        $original = parent::toArray($request);

        return array_filter(
            $original,
            fn ($atribute) => !is_null($atribute)
        );
    }
}
