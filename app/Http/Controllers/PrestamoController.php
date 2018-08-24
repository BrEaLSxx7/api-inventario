<?php

namespace App\Http\Controllers;

use App\Prestamo;
use Illuminate\Http\Request;
use App\Usuario;
use App\Material;

class PrestamoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
        $user = new Usuario();
        $user->telefono = $request->telefono;
        $user->nombre = $request->nombre;
        $user->correo = $request->correo;
        $user->id_rol = 2;
        if ($user->save()) {
            $prestamo = new Prestamo();
            $prestamo->id_usuario = $user->id;
            $prestamo->estado = true;
            if ($prestamo->save()) {
                try {
                    $material = Material::where('id', $request->id)->firstOrFail();
                    $material->id_prestamo = $prestamo->id;
                    if ($material->save()) {
                        return response()->json(['mensaje' => 'Se registro el prestamo']);
                    } else {
                        return response()->json(['mensaje' => 'ocurrio un error'], 500);
                    }
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
                    return response()->json(['mensaje' => 'ocurrio un error'], 500);
                }
            } else {
                return response()->json(['mensaje' => 'ocurrio un error'], 500);
            }
        } else {
            return response()->json(['mensaje' => 'ocurrio un error'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(Prestamo $prestamo) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestamo $prestamo) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo) {
        //
    }

}
