<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class proveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedores')->insert([
        	'idProveedoresSucursal' 	=> mt_rand(1,3),
        	'idProveedoresSuscripcion' 	=> mt_rand(1,7),
        	'idActividad' 				=> mt_rand(1,7),
        	'nomProveedor'				=> Str::random(10),
        	'logoProveedor' 			=> Str::random(10),
        	'aliasProveedor' 			=> Str::random(10),
        	'rfcProveedor' 				=> Str::random(10),
        	'calleProveedor'			=> Str::random(10),
        	'nextProveedor'  			=> Str::random(10),
        	'nintProveedor'  			=> Str::random(10),
        	'colProveedor'  			=> Str::random(10),
        	'munProveedor'  			=> Str::random(10),
        	'estadoProveedor'  			=> Str::random(10),
        	'cpProveedor'  				=> Str::random(10),
        	'esActivo' 					=> 1,
        	'emailProveedor'  			=> Str::random(10),
        	'paisProveedor' 			=> Str::random(10),
        	'creadoPor' 				=> Str::random(10),
        	'editadoPor' 				=> Str::random(10),
        ]);
    }
}
