<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\usuario;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return usuario::all();
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
        try {
            $user = new usuario;
            $user->nomUsuario = $request->usuario;
            $user->correoUsuario = $request->correo;
            $user->pwdUsuario = $request->contrasenia;
            $user->codigoVerificacion = $request->codigo;
            $user->tipo = 2;
            $user->save();
            
        }catch (Exception $e) {
            echo "Exception: ".$e->getMessage();
        }
    }

    public function guardar(Request $request){

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        try {
            $user = usuario::where('codigoConfirmacion', $code)->first();
            
            return $user;
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
        //
    }


    public function updateUserStatus($id){
      try {
          
          $user = usuario::find($id);
          if(!empty($user)){
              $user->codigoConfirmacion = null;
              $user->correo_verificado = 1;
              $user->save();
              return response()->json(['status' => 'true']);   
          }
              return response()->json(['status' => 'false']);  
          
      } catch (Exception $e) {
          echo "Exception: ".$e->getMessage();
      }
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
