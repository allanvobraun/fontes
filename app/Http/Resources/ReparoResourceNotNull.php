<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Reparo;

class ReparoResourceNotNull extends Reparo
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $original = parent::toArray($request);

        return array_filter(
            $original,
            function ($atribute) {
                return !is_null($atribute);
            }
        );
    }
}
