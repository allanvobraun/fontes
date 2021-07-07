<?php

namespace App\Http\Controllers;

use App\Http\Filters\DateFilter;
use App\Http\Requests\CreateReparoRequest;
use App\Http\Requests\ReparosRequest;
use App\Http\Resources\ReparoResource;
use App\Http\Resources\ReparoResourceNotNull;
use App\Models\Fonte;
use App\Models\Reparo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReparosController extends Controller
{
    public function getReparos(ReparosRequest $request, $cod_interno)
    {
        $items = Fonte::where('cod_interno', $cod_interno)->reparos()->get();
        return ReparoResource::collection($items);
    }

    public function getAllReparos(Request $request)
    {
        try {
            $reparos = QueryBuilder::for(Reparo::class)
                ->allowedFields(['created_at', 'valor'])
                ->allowedFilters([
                    AllowedFilter::custom('dia', new DateFilter),
                    AllowedFilter::custom('mes', new DateFilter),
                    AllowedFilter::custom('ano', new DateFilter)
                ])
                ->get();
        } catch (\Throwable $th) {
            return jsonError($th);
        }

        return jsonData(ReparoResourceNotNull::collection($reparos));
    }

    public function getAllReparosSum(Request $request)
    {
        try {
            $sumReparos = QueryBuilder::for(ReparoResource::class)
                ->allowedFilters([
                    AllowedFilter::custom('dia', new DateFilter),
                    AllowedFilter::custom('mes', new DateFilter),
                    AllowedFilter::custom('ano', new DateFilter)
                ])
                ->sum('valor');
        } catch (\Throwable $th) {
            return jsonError($th);
        }
        return jsonData(round($sumReparos, 2));
    }

    public function getValorReparosAno(Request $request)
    {
        try {
            $ano = $request->ano;
            $reparos = Reparo::selectRaw('round(sum(`valor`), 2) as valor, month(created_at) as mes')
                ->whereYear('created_at', '=', $ano)
                ->groupBy('mes')->get();
        } catch (\Throwable $th) {
            return jsonError($th);
        }
        return jsonData($reparos);
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
