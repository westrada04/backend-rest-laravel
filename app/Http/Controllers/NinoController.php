<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\Http\Requests;

class NinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
    //    $this->middleware('jwt.auth');
    }

    public function index()
    {

    }


    public function seguidos()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cuidador = $user->cuidador;
        $ninos = $cuidador->ninos()->get();
        $usuarios = [];
        foreach ($ninos as $nino){
            $us = User::find($nino->user_id);
            array_push($usuarios,$us);
        }

        return response()->json($usuarios);
    }

    public function posicion(Request $request){

        $user = JWTAuth::parseToken()->authenticate();
        $user->lat = $request->input('lat');
        $user->lng = $request->input('lng');
        $user->save();

        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $nino = new Nino;
        $user->nino()->save($nino);

        try {
            if (! $token = JWTAuth::fromUser($user) ){
                return response()->json(['error' => 'Credenciales Invalidas'],401);
            }
        } catch (JWTException $e){
            return response()->json(['error' => 'No se ha podido crear el Token'], 500);
        }

        return response()->json(compact('token','user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
