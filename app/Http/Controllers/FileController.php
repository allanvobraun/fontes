<?php

namespace App\Http\Controllers;

use App\Services\FileService;

class FileController extends Controller
{
    public function getWalpaper()
    {
        return FileService::randomWalpaper();
    }
}
