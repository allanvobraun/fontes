<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReparoRequest;
use App\Http\Requests\RelationReparoRequest;
use App\Http\Resources\ReparoResource;
use App\Models\Fonte;
use App\Models\Reparo;
use App\Services\ReparoService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReparosController extends Controller
{
    public function getReparos(RelationReparoRequest $request, $fonteId)
    {
        $items = Reparo::where('fonte_id', $fonteId)->orderBy('created_at', 'ASC')->get();
        return jsonData(ReparoResource::collection($items));
    }

    public function getValorReparosAno(Request $request)
    {
        $years = $request->anos;
        try {
            $reparosValuesByYear = ReparoService::sumReparosByYear($years);
        } catch (\Throwable $th) {
            return jsonError($th);
        }
        return jsonData($reparosValuesByYear);
    }

    public function getValoresReparosUltimasSemanas()
    {
        $reparosUltimasSemanas = Reparo::selectRaw('sum(`valor`) as valor, date(created_at) as reparo_data')
            ->duasSemanasAtras(Carbon::now())
            ->groupBy('reparo_data')
            ->get();
        $agrupadoSemanas = $reparosUltimasSemanas->groupBy(function ($date) {
            return Carbon::parse($date->reparo_data)->weekOfYear;
        });
        return jsonData($agrupadoSemanas);
    }

    public function newReparo(ReparoRequest $request, $fonteId)
    {
        $fonte = Fonte::find($fonteId);
        $reparo = $fonte->reparos()->create($request->all());
        return jsonData($reparo, 201);
    }

    public function editReparo(ReparoRequest $request, $fonteId, $id)
    {
        $fields = $request->only(['desc_problema', 'peças', 'valor', 'status']);
        $fonte = Fonte::find($fonteId);
        $fonte->reparos()->where('id', $id)->update($fields);
        return jsonData($fonte->reparos()->where('id', $id)->first());
    }
}
