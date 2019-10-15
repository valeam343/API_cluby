<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;

class actividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Actividad::all();
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
        //
        $actividad = new Actividad;
        $actividad->idCategoria = $request->idCategoria;
        $actividad->nombre = $request->nombre;
        $actividad->descripcion = $request->descripcion;
        $actividad->imagen = $request->imagen;
        $actividad->city = $request->city;
        $actividad->lat = $request->lat;
        $actividad->long = $request->long;
        $actividad->telefono = $request->telefono;
        $actividad->save();
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

        return Actividad::where('idActividad', [$id])->get();
    }

    public function actividadFkCategoria($idCat){
        return Actividad::where('idCategoria',[$idCat])->get();
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
        $actividad = Actividad::findOrFail([$id]);
        $actividad->update($request->all());

        return $actividad;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Actividad::findOrFail($id);

        $actividad->delete();

        return $actividad;
    }
}
