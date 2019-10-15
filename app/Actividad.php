<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    
    protected $table = 'actividades';
    protected $fillable = ['idCategoria','nombre', 'descripcion', 'imagen', 'city', 'lat', 'long', 'telefono' ];
}
