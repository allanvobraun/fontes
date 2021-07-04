<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(Request $request)
    {
        return new UserResource($request->user());
    }

    public function delete(int $id)
    {
        try {
            User::find($id)->delete();
            return response('', 200);

        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
