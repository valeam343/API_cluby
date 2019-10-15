<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
use Carbon\CarbonImmutable;
use Carbon\Carbon;
class proveedoresSucursalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedoressucursales')->insert([
        	'idActividadGrupos' => mt_rand(1,4),
        	'nomProveedorSucursal' => Str::random(10),
        	'calleProveedorSucursal' => Str::random(10),
        	'nextProveedorSucursal' => Str::random(10),
        	'nintProveedorSucursal' => Str::random(10),
        	'colProveedorSucursal' => Str::random(10),
        	'munProveedorSucursal' => Str::random(10),
        	'estadoProveedorSucursal' => Str::random(10),
        	'cpProveedorSucursal' => mt_rand(10000,99999),
        	'esActivo' => 1,
        	'emailProveedorSucursal' => Str::random(10).'@gmail.com',
        	'telProveedorSucursal' => mt_rand(100000000000,999999999999),
        	'latitud' => mt_rand(-999999,999999),
        	'longitud'=> mt_rand(-1000000000,9999999999),
        	'creadoPor' => Str::random(10),
        	'editadoPor' => Str::random(10),
        ]);
    }
}
