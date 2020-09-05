<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Fonte as FonteResource;
use App\Http\Resources\Reparo as ReparoResource;
use App\Http\Resources\ReparoResourceNotNull;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Fonte;
use App\Models\Reparo;
use App\Http\Requests\StoreFonte;
use App\Http\Requests\StoreReparo;
use App\Http\Requests\SearchFonte;
use App\Http\Requests\SearchOneFonte;
use App\Http\Requests\GetReparos;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Filters\DateFilter;

class FontesController extends Controller
{
    public function getFontes()
    {
        $items = Fonte::orderBy('cod_interno', 'DESC')->paginate(5);
        return FonteResource::collection($items);
    }

    public function newFonte(StoreFonte $request)
    {
        return Fonte::create($request->all());
    }

    public function getFonte(SearchOneFonte $request, $cod_interno)
    {
        return jsonData(Fonte::find($cod_interno));
    }

    public function searchFonte(SearchFonte $request)
    {
        $query = $request->query('query');
        $attribute = $request->query('attribute');
        $result = Fonte::likeSearch($attribute, $query);

        return response()->json([
            'data' => $result
        ]);
    }
}
