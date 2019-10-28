<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use Illuminate\Support\Facades\DB;

class actividadController extends Controller
{
    /**
     * Muesta actividad con sus propiedades relacionadas.
     *

     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try {
        $actividades = DB::table('actividades as a')
        ->leftJoin('actividadimagen as ai', 'a.pkActividad', '=', 'ai.idActividad')
        ->leftJoin('proveedores as p', 'a.idProveedor', '=', 'p.pkProveedor')
        ->leftJoin('proveedoressucursales as ps', 'p.pkProveedor', '=', 'ps.idProveedores')
        ->select('a.*', 'ai.rutaimagen', 'p.*', 'ps.latitud', 'ps.longitud')
        ->groupBy('ai.idActividad')
        ->havingRaw('min(ai.fechaCreado)')
        ->get();

        return response()->json($actividades);
    } catch (Exception $e) {

    }


}

public function ciudades(){
    try {
        $actividad = DB::table('actividades as a')
        ->leftJoin('proveedores as p', 'a.idProveedor', '=', 'p.pkProveedor')
        ->leftjoin('ciudades as c', 'p.idCiudad', '=', 'c.pkCiudad')
        ->select('c.nomCiudad')->distinct()->get();
        return response()->json($actividad);
    } catch (Exception $e) {

    }

}


 /**
     * Crea un nuevo registro de actividad.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
 {
    try {
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
    } catch (Exception $e) {
        
    }
    
}

    /**
     * obtiene una actividad filtrado por nombre.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nombre)
    {
       try {
           $actividad = DB::table('actividades as a')
           ->leftJoin('actividadimagen as ai', 'a.pkActividad', '=', 'ai.idActividad')
           ->leftJoin('proveedores as p', 'a.idProveedor', '=', 'p.pkProveedor')
           ->leftjoin('ciudades as c', 'p.idCiudad', '=', 'c.pkCiudad')
           ->leftJoin('proveedoressucursales as ps', 'p.pkProveedor', '=', 'ps.idProveedores')
           ->select('a.*', 'ai.rutaimagen', 'c.nomCiudad','p.*', 'ps.latitud', 'ps.longitud')
           ->where('a.nomActividad', '=', $nombre)
           ->groupBy('ai.idActividad')
           ->havingRaw('min(ai.fechaCreado)')->
           get();
           return response()->json($actividad);
       } catch (Exception $e) {

       }

   }

    //Obtener imagenes de cada actividad
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
//obtener grupos relacionados con una actividad

public function getGruposPorActividad($id){
    try {
        $aGrupos = DB::table('actividadesgrupos')
        ->where('idActividad', '=', $id)->get();

        return response()->json($aGrupos);
    } catch (Exception $e) {
        echo "Exception ".$e->getMessage();
    }
}

/*
*Filtra actividades por nombre de categoria 
*/
public function filtroHome($variable, $nombre){
    try {
     $query =  DB::table('actividades')
     ->leftJoin('actividadimagen as ai', 'actividades.pkActividad', '=', 'ai.idActividad')
     ->join('actividadescategorias','actividades.pkActividad', '=', 'actividadescategorias.idActividad')
     ->join('categorias', 'actividadescategorias.idCategoria', '=', 'categorias.pkCategoria')
     ->select('actividades.*', 'ai.rutaimagen');
     switch ($variable) {
         case 'first':
         $act = $query->where('actividades.nomActividad', 'LIKE', '%'.$nombre.'%')
         ->groupBy('ai.idActividad')
         ->havingRaw('min(ai.fechaCreado)')->get();

         if(($act)->isEmpty()){
            $cat = $query->where('categorias.nomCategoria', 'LIKE', '%'.$nombre.'%')
            ->groupBy('ai.idActividad')
            ->havingRaw('min(ai.fechaCreado)')->get();
            return response()->json($cat);

        }
        return response()->json($act);
        break;

        case 'second':
        $loc = DB::table('actividades as a')
        ->leftjoin('proveedores as p', 'a.idProveedor' , '=', 'p.pkProveedor')->select('a.*', 'p.*')->where('p.estadoProveedor', 'LIKE', '%'.$nombre.'%')->orWhere('p.munProveedor', 'LIKE', '%'.$nombre.'%')->get();
        return response()->json($loc);
        break;

        default:

        break;


    }
} catch (Exception $e) {

} 
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