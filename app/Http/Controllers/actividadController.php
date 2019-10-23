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
        //return Actividad::all();
         $actividades = DB::table('actividades as a')
             ->leftJoin('actividadimagen as ai', 'a.pkActividad', '=', 'ai.idActividad')
             ->leftJoin('proveedores as p', 'a.idProveedor', '=', 'p.pkProveedor')
             ->leftJoin('proveedoressucursales as ps', 'p.pkProveedor', '=', 'ps.idProveedores')
             ->select('a.*', 'ai.rutaimagen', 'p.*', 'ps.latitud', 'ps.longitud')
             ->groupBy('ai.idActividad')
             ->havingRaw('min(ai.fechaCreado)')
             ->get();

        return response()->json($actividades);
        
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
/*
        $actividad = DB::table('actividades as a')
             ->leftJoin('actividadimagen as ai', 'a.pkActividad', '=', 'ai.idActividad')
             ->leftJoin('proveedores as p', 'a.idProveedor', '=', 'p.pkProveedor')
             ->leftJoin('proveedoressucursales as ps', 'p.pkProveedor', '=', 'ps.idProveedores')
             ->select('a.*', 'ai.rutaimagen', 'p.*', 'ps.latitud', 'ps.longitud')
             ->where('a.nomActividad', '=', $id)
             ->groupBy('ai.idActividad')
             ->havingRaw('min(ai.fechaCreado)')->
             get();*/
             
        $actividad = DB::table('actividades as a')
        ->leftJoin('actividadimagen as ai', 'a.pkActividad', '=', 'ai.idActividad')
        ->leftJoin('proveedores as p', 'a.idProveedor', '=', 'p.pkProveedor')
        ->leftjoin('ciudades as c', 'p.idCiudad', '=', 'c.pkCiudad')
        ->leftJoin('proveedoressucursales as ps', 'p.pkProveedor', '=', 'ps.idProveedores')
        ->select('a.*', 'ai.rutaimagen', 'c.nomCiudad','p.*', 'ps.latitud', 'ps.longitud')
        ->where('a.nomActividad', '=', $id)
        ->groupBy('ai.idActividad')
        ->havingRaw('min(ai.fechaCreado)')->
        get();
        return response()->json($actividad);


    }
    
    public function actividadImagenes($var){
    try {
        $imagenes = DB::table('actividades as a')->
        rightjoin('actividadimagen as ai', 'a.pkActividad', '=', 'ai.idActividad')
        ->select('ai.rutaimagen')
        ->where('a.nomActividad', '=', $var)->get();
        return response()->json($imagenes);
    } catch (Exception $e) {
        
    }
}

    public function getGruposPorActividad($id){
        try {
            $aGrupos = DB::table('actividadesgrupos')
            ->where('idActividad', '=', $id)->get();

            return response()->json($aGrupos);
        } catch (Exception $e) {
            echo "Exception ".$e->getMessage();
        }
    }


    public function filtroHome($variable, $id){
     $query =  DB::table('actividades')
     ->leftJoin('actividadimagen as ai', 'actividades.pkActividad', '=', 'ai.idActividad')
     ->join('actividadescategorias','actividades.pkActividad', '=', 'actividadescategorias.idActividad')
     ->join('categorias', 'actividadescategorias.idCategoria', '=', 'categorias.pkCategoria')
     ->select('actividades.*', 'ai.rutaimagen');
     switch ($variable) {
         case 'first':
         $act = $query->where('actividades.nomActividad', 'LIKE', '%'.$id.'%')
         ->groupBy('ai.idActividad')
         ->havingRaw('min(ai.fechaCreado)')->get();

         if(($act)->isEmpty()){
            $cat = $query->where('categorias.nomCategoria', 'LIKE', '%'.$id.'%')
            ->groupBy('ai.idActividad')
             ->havingRaw('min(ai.fechaCreado)')->get();
            return response()->json($cat);

        }
        return response()->json($act);
        break;

        case 'second':
        $loc = DB::table('actividades as a')
        ->leftjoin('proveedores as p', 'a.idProveedor' , '=', 'p.pkProveedor')->select('a.*', 'p.*')->where('p.estadoProveedor', 'LIKE', '%'.$id.'%')->orWhere('p.munProveedor', 'LIKE', '%'.$id.'%')->get();
        /*
        $query->where('actividades.ciudad', 'LIKE', '%'.$id.'%')
        ->orWhere('actividades.estado', 'LIKE', '%'.$id.'%')->get();
        */
        return response()->json($loc);
        break;

        default:
                   # code...
        break;


    }
}

public function actividadFkCategoria($idCat){
    //return Actividad::where('pkCategoria',[$idCat])->get();
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
