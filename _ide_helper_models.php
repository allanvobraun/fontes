<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Fonte
 *
 * @property string $cod_interno
 * @property string $cod_font
 * @property string|null $modelo
 * @property string|null $fabricante
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reparo[] $reparos
 * @property-read int|null $reparos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Fonte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fonte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fonte query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fonte whereCodFont($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fonte whereCodInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fonte whereFabricante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fonte whereModelo($value)
 */
	class Fonte extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reparo
 *
 * @property int $id
 * @property string $cod_interno
 * @property string|null $desc_problema
 * @property string|null $peças
 * @property float $valor
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Fonte $fontes
 * @property-read mixed $data
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo duasSemanasAtras(\Carbon\Carbon $dataReferencia)
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo whereCodInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo whereDescProblema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo wherePeças($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reparo whereValor($value)
 */
	class Reparo extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class User extends \Eloquent {}
}

