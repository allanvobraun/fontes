<?php

namespace App\Http\Controllers;

use App\Http\Filters\DateFilter;
use App\Http\Requests\GetReparos;
use App\Http\Requests\StoreReparo;
use App\Http\Resources\Reparo as ReparoResource;
use App\Http\Resources\ReparoResourceNotNull;
use Illuminate\Http\Request;
use App\Models\Reparo;
use App\Models\Fonte;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Carbon\Carbon;

class ReparosController extends Controller
{
    public function getReparos(GetReparos $request, $cod_interno)
    {
        $items = Fonte::find($cod_interno)->reparos()->get();
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
            $sumReparos = QueryBuilder::for(Reparo::class)
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

    public function newReparo(StoreReparo $request, $cod_interno)
    {
        return Fonte::find($cod_interno)->reparos()->create($request->all());
    }

}
