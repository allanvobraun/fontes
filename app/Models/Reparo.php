<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Reparo extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $attributes = [
        'valor' => 0
    ];
    protected $guarded = ['created_at', 'updated_at', 'fonte_id','id'];

    protected static function booted()
    {
        static::creating(fn(Reparo $reparo) => $reparo->id = Uuid::uuid4()->toString());
    }

    public function fontes()
    {
        return $this->belongsTo(Fonte::class);
    }

    public function getDataAttribute()
    {
        if (is_null($this->created_at)) {
            return null;
        }
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function scopeDuasSemanasAtras($query, Carbon $dataReferencia)
    {
        $semanaRetrasada = $dataReferencia->startOfWeek(Carbon::MONDAY)->subWeek()->subWeek();
        return $query->where('created_at', '>=', $semanaRetrasada);
    }

}
