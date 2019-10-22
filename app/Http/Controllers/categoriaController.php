<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Actividad;
use Illuminate\Support\Facades\DB;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Categoria::all();
    }

    public function actividadesPorCategoria($id){
        try {
            $query =  DB::table('actividades')
                       ->join('actividadescategorias','actividades.pkActividad', '=', 'actividadescategorias.idActividad')
                       ->join('categorias', 'actividadescategorias.idCategoria', '=', 'categorias.pkCategoria')
                       ->leftjoin('proveedores as p', 'actividades.idProveedor' , '=', 'p.pkProveedor')
                       ->select('actividades.*', 'categorias.*', 'p.*')->where('categorias.pkCategoria', '=', $id)->distinct()->get();

                       return response()->json($query);

        } catch (Exception $e) {
            echo "Exception: ".$e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\reset(array)ponse
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Categoria::where('pkCategoria', [$id])->get();
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
