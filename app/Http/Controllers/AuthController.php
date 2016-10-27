<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function userAuth(Request $request){

        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        $credenciales = $request->only('email','password');
        
        try {
            if (! $token = JWTAuth::attempt($credenciales) ){
                return response()->json(['error' => 'Credenciales Invalidas'],401);
            }
        } catch (JWTException $e){
                return response()->json(['error' => 'No se ha podido crear el Token'], 500);
        }
        $user = JWTAuth::toUser($token);

        return response()->json(compact('token','user'));
    }
}
