<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Auth;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    public function __invoke(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
       $credentials = $request->only('username','password');

       if(!$token = auth()->guard('api')->attempt($credentials)){
        return response()->json([
            'success' => false,
            'message' => 'Username atau password anda salah'
        ],401);
       }
        return response()->json([
            'success' => true,
            'user' => auth()->guard('api')->user(),
            'token' => $token
        ], 200);
    }
}