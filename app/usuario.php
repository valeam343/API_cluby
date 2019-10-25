<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    //
    protected $primaryKey = 'pkUsuario';
    public $timestamps = false;
    /*protected $fillable =['nomUsuario', 'correoUsuario','pwdUsuario'];*/
}
