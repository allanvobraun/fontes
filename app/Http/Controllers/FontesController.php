<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\FonteResource;
use App\Models\Fonte;
use App\Http\Requests\StoreFonte;
use App\Http\Requests\SearchFonte;
use App\Http\Requests\SearchOneFonte;

class FontesController extends Controller
{
    public function getFontes(Request $request)
    {
        $fontes = Fonte::orderBy('cod_interno', 'DESC');
        if ($request->search) {
            $items = $fontes->searchInFields($request->search)->paginate(10);
            return FonteResource::collection($items);
        }
        $items = $fontes->paginate(10);
        return FonteResource::collection($items);
    }

    public function newFonte(StoreFonte $request)
    {
        return Fonte::create($request->all());
    }

    public function getFonte(SearchOneFonte $request, $cod_interno)
    {
        $fonte = Fonte::where('cod_interno', $cod_interno)->first();
        return jsonData($fonte);
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
