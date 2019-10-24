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
                       ->leftJoin('actividadimagen as ai', 'actividades.pkActividad', '=', 'ai.idActividad')
                       ->join('actividadescategorias','actividades.pkActividad', '=', 'actividadescategorias.idActividad')
                       ->join('categorias', 'actividadescategorias.idCategoria', '=', 'categorias.pkCategoria')
                       ->leftjoin('proveedores as p', 'actividades.idProveedor' , '=', 'p.pkProveedor')
                       ->leftJoin('proveedoressucursales as ps', 'p.pkProveedor', '=', 'ps.idProveedores')
                       ->select('actividades.*', 'categorias.*', 'p.*', 'ps.latitud', 'ps.longitud', 'ai.rutaimagen')->where('categorias.pkCategoria', '=', $id)
                       ->groupBy('ai.idActividad')
                       ->havingRaw('min(ai.fechaCreado)')->get();

                       return response()->json($query);

        } catch (Exception $e) {
            echo "Exception: ".$e->getMessage();
        }
    }

   public function busquedaPorActividadEstado(Request $request){
           try{
               $actividad = $request->actividad;
               $estado = $request->estado;
                $query =  DB::table('actividades')
                    ->leftJoin('actividadimagen as ai', 'actividades.pkActividad', '=', 'ai.idActividad')
                    ->join('actividadescategorias','actividades.pkActividad', '=', 'actividadescategorias.idActividad')
                    ->join('categorias', 'actividadescategorias.idCategoria', '=', 'categorias.pkCategoria')
                    ->leftjoin('proveedores as p', 'actividades.idProveedor' , '=', 'p.pkProveedor')
                    ->leftjoin('ciudades as c', 'p.idCiudad', '=', 'c.pkCiudad')
                    ->leftJoin('proveedoressucursales as ps', 'p.pkProveedor', '=', 'ps.idProveedores')
                    ->select('actividades.*', 'categorias.*', 'p.*', 'ps.latitud', 'ps.longitud', 'ai.rutaimagen','c.nomCiudad');
               if(!empty($actividad) && !empty($estado)){
                   $both = $query->where('actividades.nomActividad', '=', $actividad)
                   ->where('c.nomCiudad', '=', $estado)
                   ->groupBy('ai.idActividad')
                   ->havingRaw('min(ai.fechaCreado)')->get();
                   return response()->json($both);
               }else if(!empty($actividad) || !empty($estado)){
                   if(empty($actividad)){
                       $estados = $query->where('c.nomCiudad','=',$estado)
                       ->groupBy('ai.idActividad')
                       ->havingRaw('min(ai.fechaCreado)')->get();
                       return response()->json($estados);
                   }else{
                       $actividades = $query->where('actividades.nomActividad', '=', $actividad)
                       ->groupBy('ai.idActividad')
                       ->havingRaw('min(ai.fechaCreado)')->get();
                       return response()->json($actividades);
                   }
               }
           }catch(Exception $e){
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
        return Categoria::where('nomCategoria', [$id])->get();
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