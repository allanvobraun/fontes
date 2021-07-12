<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetFonteRequest;
use Illuminate\Http\Request;
use App\Http\Resources\FonteResource;
use App\Models\Fonte;
use App\Http\Requests\FonteRequest;
use App\Http\Requests\SearchFonte;

class FontesController extends Controller
{
    public function getFonte($id)
    {
        $fonte = Fonte::with('reparos')->find($id);
        if ($fonte) {
            return jsonData(new FonteResource($fonte));
        }

        abort(404, 'Essa fonte não existe');
    }

    public function getFonteByCodInterno(GetFonteRequest $request, $cod_interno)
    {
        $fonte = Fonte::where('cod_interno', $cod_interno)->first();
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
        $fonte = Fonte::find($id);
        $fonte->update($request->all());
        return jsonData($fonte->fresh());
    }

    public function newFonte(FonteRequest $request)
    {
        $fonte = Fonte::create($request->all());
        return jsonData($fonte, 201);
    }

    public function searchFonte(SearchFonte $request)
    {
        $query = $request->query('query');
        $attribute = $request->query('attribute');
        $result = Fonte::likeSearch($attribute, $query);

        return jsonData($result);
    }
}
