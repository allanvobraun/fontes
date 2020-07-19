<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reparo extends Model
{


    protected $attributes = [
        'valor' => 0
    ];
    protected $guarded = ['created_at', 'updated_at'];
    protected $appends = ['created_at'];

    public function fontes()
    {
        return $this->belongsTo('App\Models\Fonte', 'cod_font', 'cod_font');
    }

    public function getCreatedAtAttribute($data)
    {
        return Carbon::parse($data)->format('d/m/Y');
    }

}
