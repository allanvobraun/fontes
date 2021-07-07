<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Fonte extends Model
{
    use HasFactory;
    public $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['created_at', 'updated_at', 'id'];

    protected static function booted()
    {
        static::creating(fn(Fonte $fonte) => $fonte->id = Uuid::uuid4()->toString());
    }

    public function reparos()
    {
        return $this->hasMany(Reparo::class);
    }

    public static function likeSearch(string $field, string $query)
    {
        return self::where($field, 'like', "%{$query}%")->limit(20)->pluck($field);
    }

    public function scopeSearchInFields($query, string $search)
    {
        return $query->whereRaw("CONCAT_WS('&', cod_interno, cod_font, modelo, fabricante) like ?", ["%{$search}%"]);
    }
}
