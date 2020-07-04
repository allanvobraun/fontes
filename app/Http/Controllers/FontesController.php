<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Resources\Fonte as FonteResource;
use App\Models\Fonte;
use App\Models\Reparo;
use App\Http\Requests\StoreFonte;
use App\Http\Requests\StoreReparo;

class FontesController extends Controller
{
    public function index()
    {
        return FonteResource::collection(Fonte::all());
    }

    public function newFonte(StoreFonte $request)
    {
        return Fonte::create($request->all());
    }

    public function newReparo(StoreReparo $request, $cod_font)
    {
        $fonte = Fonte::find($cod_font)->reparos()->create($request->all());
        return $fonte;
    }
        
    
}
