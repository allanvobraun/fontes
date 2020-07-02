<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reparo extends Model
{

    public function fontes()
    {
        return $this->belongsTo('App\Models\Fonte', 'cod_font', 'cod_font');
    }

    public function getCreatedAtAttribute($data)
    {
        return Carbon::parse($data)->format('d/m/Y');
    }
}
