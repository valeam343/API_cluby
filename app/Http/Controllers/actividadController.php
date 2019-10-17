<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use Illuminate\Support\Facades\DB;

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

        //return Actividad::where('pkActividad', [$id])->get();

        $aBusquedad = DB::table('actividades')->where('idActividad', 'LIKE', '%'. $id. '%');
        return response()->json(json_encode($aBusquedad));

     
    }


    public function filtroHome($variable, $id){
           $query =  DB::table('actividades')
           ->join('actividadescategorias','actividades.pkActividad', '=', 'actividadescategorias.idActividad')
           ->join('categorias', 'actividadescategorias.idCategoria', '=', 'categorias.pkCategoria')
           ->select('actividades.*');
           switch ($variable) {
               case 'first':
                   
                   $act = $query->where('actividades.nomActividad', 'LIKE', '%'.$id.'%')->get();

                   if(empty($act)){
                    $cat = $query->where('categorias.nomCategoria', 'LIKE', '%'.$id.'%');
                    return response()->json($cat);

                   }
                   return response()->json($act);
                   break;

               case 'second':
                   
                   $loc = $query->where('actividades.ciudad', 'LIKE', '%'.$id.'%')
                   ->orWhere('actividades.estado', 'LIKE', '%'.$id.'%')->get();
                   return response()->json($loc);
                   break;
               
               default:
                   # code...
                   break;
           
           
        }
    }

 public function actividadFkCategoria($idCat){
    return Actividad::where('idCategoria',[$idCat])->get();
}

public function filtrar($sParam){

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
