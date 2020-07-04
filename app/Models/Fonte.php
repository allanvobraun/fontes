<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fonte extends Model
{
    protected  $primaryKey = 'cod_font';
    public $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;

    
    public function reparos()
    {
        return $this->hasMany('App\Models\Reparo', 'cod_font', 'cod_font');
    }
}
