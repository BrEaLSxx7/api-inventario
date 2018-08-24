<?php

namespace App\Http\Controllers;

use App\Autenticacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Usuario;

class AutenticacionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(Autenticacion::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Autenticacion  $autenticacion
     * @return \Illuminate\Http\Response
     */
    public function show(Autenticacion $autenticacion) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Autenticacion  $autenticacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Autenticacion $autenticacion) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Autenticacion  $autenticacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autenticacion $autenticacion) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Autenticacion  $autenticacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autenticacion $autenticacion) {
        //
    }

    public function auth(Request $request) {
        try {
            $auth = Autenticacion::where('usuario', $request->usuario)->firstOrFail();
            if (Hash::check($request->contrasena, $auth->contrasena)) {
                try {
                    $data = Usuario::where('id', $auth->id_usuario)->firstOrFail();
                    return response()->json(['token' => $auth->token, 'usuario' => $data], 200);
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
                    return response()->json(['mensaje' => 'Datos incorrectos'], 401);
                }
            } else {
                return response()->json(['mensaje' => 'Datos incorrectos'], 401);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['mensaje' => 'Datos incorrectos'], 401);
        }
    }

}
