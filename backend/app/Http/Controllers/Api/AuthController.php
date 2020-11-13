<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request, User $user)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        if(!Auth::attempt(['email' => $email, 'password' => $password])){
            return response()->json([
                'status' => false,
                'message' => 'Your credential is wrong, please try again later'
            ], 401);
        }else{
            $user = $user->find(Auth::user()->id);
            return response()->json([
                'status' => true,
                'message' => 'Successfully Login',
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'api_token' => Auth::user()->api_token,
            ], 201);
        }
    }

    public function signup(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users,email' . $user->id,
            'password' => 'required|min:4'
        ]);

       try {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => bcrypt($request->email)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Register berhasil',
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => bcrypt($request->email)
        ], 201);


       } catch (\Exception $e) {
          return response()->json($e->getMessage());
       }



    }

}
