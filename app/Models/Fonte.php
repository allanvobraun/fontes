<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Fonte extends Model
{
    use HasFactory, SoftDeletes;

    public $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['created_at', 'updated_at', 'id'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function (Fonte $record) {
            $record->reparos()->delete();
        });
    }

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
        if (app()->runningUnitTests()) {
            return $query->whereRaw("cod_interno || '&' || cod_font || '&' || modelo || '&' || fabricante like ?", ["%{$search}%"]);
        }
        return $query->whereRaw("CONCAT_WS('&', cod_interno, cod_font, modelo, fabricante) like ?", ["%{$search}%"]);
    }

    public function getDataAttribute()
    {
        if (is_null($this->created_at)) {
            return null;
        }
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
