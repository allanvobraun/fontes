<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reparo extends Model
{

    protected $attributes = [
        'valor' => 0
    ];
    protected $guarded = ['created_at','updated_at'];

    public function fontes()
    {
        return $this->belongsTo('App\Models\Fonte', 'cod_font', 'cod_font');
    }

    public function getDataAttribute()
    {   
        if (is_null($this->created_at)) {
            return null;
        }
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

}
