<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function users()
    {
        $data = User::all();
        return response()->json($data);
    }


    public function usersFind($id)
    {
        try {

            $data = User::find($id);
            return response()->json($data);

        } catch (\Exception $e) {
           return response()->json($e->getMessage());
        }
    }
}
