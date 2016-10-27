<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

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

    public function userSignup(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        try {
            if (! $token = JWTAuth::fromUser($user) ){
                return response()->json(['error' => 'Credenciales Invalidas'],401);
            }
        } catch (JWTException $e){
            return response()->json(['error' => 'No se ha podido crear el Token'], 500);
        }

        return response()->json(compact('token','user'));
    }

}
