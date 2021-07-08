<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReparoRequest;
use App\Http\Requests\ReparosRequest;
use App\Http\Resources\ReparoResource;
use App\Models\Fonte;
use App\Models\Reparo;
use App\Services\ReparoService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReparosController extends Controller
{
    public function getReparos(ReparosRequest $request, $cod_interno)
    {
        $items = Fonte::where('cod_interno', $cod_interno)->first()->reparos()->get();
        return ReparoResource::collection($items);
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

    public function newReparo(CreateReparoRequest $request, $cod_interno)
    {
        $fonte = Fonte::where('cod_interno', $cod_interno)->first();
        return $fonte->reparos()->create($request->all());
    }
}
