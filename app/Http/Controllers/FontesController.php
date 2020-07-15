<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Fonte as FonteResource;
use App\Models\Fonte;
use App\Models\Reparo;
use App\Http\Requests\StoreFonte;
use App\Http\Requests\StoreReparo;
use App\Http\Requests\SearchFonte;
use App\Http\Requests\SearchOneFonte;

class FontesController extends Controller
{
    public function index()
    {

        $count = DB::table('fontes')
            ->leftJoin('reparos', 'fontes.cod_interno', '=', 'reparos.cod_interno')
            ->count();

        $items = Fonte::paginate(5);

        return FonteResource::collection($items)->additional(['meta' => [
            'total_join' => $count,
        ]]);
    }

    public function newFonte(StoreFonte $request)
    {
        return Fonte::create($request->all());
    }

    public function getFonte(SearchOneFonte $request, $cod_interno)
    {
        return jsonData(Fonte::find($cod_interno));
    }

    public function newReparo(StoreReparo $request, $cod_interno)
    {
        $fonte = Fonte::find($cod_interno)->reparos()->create($request->all());
        return $fonte;
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
