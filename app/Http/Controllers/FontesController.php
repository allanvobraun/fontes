<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Fonte as FonteResource;
use App\Models\Fonte;

class FontesController extends Controller
{
    public function index()
    {
        return FonteResource::collection(Fonte::all());
    }
}
