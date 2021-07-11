<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\FonteResource;
use App\Models\Fonte;
use App\Http\Requests\FonteRequest;
use App\Http\Requests\SearchFonte;

class FontesController extends Controller
{
    public function getFonte($id)
    {
        $fonte = Fonte::find($id);
        return jsonData($fonte);
    }

    public function getFontes(Request $request)
    {
        $fontes = Fonte::orderBy('cod_interno', 'DESC');
        $items = $fontes;
        if ($request->search) {
            $items = $fontes->searchInFields($request->search);
        }

        return FonteResource::collection($items->paginate(10));
    }

    public function editFonte(FonteRequest $request, $id)
    {
        return Fonte::where('id', $id)->update($request->all());
    }

    public function newFonte(FonteRequest $request)
    {
        return Fonte::create($request->all());
    }

    public function searchFonte(SearchFonte $request)
    {
        $query = $request->query('query');
        $attribute = $request->query('attribute');
        $result = Fonte::likeSearch($attribute, $query);

        return jsonData($result);
    }
}
