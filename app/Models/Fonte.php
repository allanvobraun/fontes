<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fonte extends Model
{
    protected  $primaryKey = 'cod_interno';
    public $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;


    public function reparos()
    {
        return $this->hasMany('App\Models\Reparo', 'cod_interno', 'cod_interno');
    }

    public static function likeSearch(string $field, string $query)
    {
        return self::where($field, 'like', "%{$query}%")->limit(20)->pluck($field);
    }
}
