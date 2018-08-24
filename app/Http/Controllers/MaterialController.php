<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Prestamo;

class MaterialController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(Material::all(), 200);
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
        $material = new Material();
        $material->nombre = $request->nombre;
        $material->referencia = $request->referencia;
        $material->codigo = $request->codigo;
        $material->descripcion = $request->descripcion;
        if ($material->save()) {
            return response()->json(['mensaje' => 'Agregado correctamente'], 200);
        } else {
            return response()->json(['mensaje' => 'Ocurrio un problema'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material) {
        try {
            $prestamo = Prestamo::where('id', $material->id_prestamo)->firstOrFail();
            $prestamo->estado = false;
            if ($prestamo->save()) {
                $material->id_prestamo = null;
                if ($material->save()) {
                    return response()->json(['mensaje' => 'Devolucion correcta'], 200);
                } else {
                    return response()->json(['mensaje' => 'Ocurrio un error'], 500);
                }
            } else {
                return response()->json(['mensaje' => 'Ocurrio un error'], 500);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['mensaje' => 'Ocurrio un error'], 500);
        }
        var_dump($material);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material) {
        $material->nombre = $request->nombre;
        $material->referencia = $request->referencia;
        $material->codigo = $request->codigo;
        $material->descripcion = $request->descripcion;
        if ($material->save()) {
            return response()->json(['mensaje' => 'Actualizado correctamente'], 200);
        } else {
            return response()->json(['mensaje' => 'Ocurrio un problema'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material) {
        if ($material->delete()) {
            return response()->json(['mensaje' => 'Borrado correctamente'], 200);
        } else {
            return response()->json(['mensaje' => 'Ocurrio un error'], 500);
        }
    }

    public function reporte() {
        $bodega = DB::table('materials')->whereNull('id_prestamo')->get();
        $prestamo = DB::table('materials')->whereNotNull('id_prestamo')->get();
        $report = DB::table('materials')->select(DB::raw('count(*) as total, nombre'))->groupBy('nombre')->get();
        return response()->json(['Bodega' => count($bodega), 'Prestamo' => count($prestamo), 'reports' => $report]);
    }

}
