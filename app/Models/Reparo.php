<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Kyslik\LaravelFilterable\Filterable;

class Reparo extends Model
{
    use Filterable;


    protected $attributes = [
        'valor' => 0
    ];
    protected $guarded = ['created_at', 'updated_at'];

    public function fontes()
    {
        return $this->belongsTo('App\Models\Fonte', 'cod_font', 'cod_font');
    }

    public function getCreatedAtAttribute($data)
    {
        return Carbon::parse($data)->format('d/m/Y');
    }

}
