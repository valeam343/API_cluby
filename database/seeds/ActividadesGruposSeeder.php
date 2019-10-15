<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
use Carbon\CarbonImmutable;
use Carbon\Carbon;
class ActividadesGruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $edad1 = mt_rand(3, 17);
        $edad2 = mt_rand($edad1, 18);
        DB::table('actividadesgrupos')->insert([
        	'idActividad' => mt_rand(1,7),
        	'capActividadesGrupos' => str::random(10), 
        	'edadMinimaActividadesGrupos' => $edad1,
        	'edadMaximaActividadesGrupos' => $edad2,
        	'fInicialActividadesGrupos' =>  $randomI = Carbon::now()->subMinutes(rand(1, 55)),
        	'fFinalActividadesGrupos' => $randomF = Carbon::now()->subMinutes(rand(1, 55))->addDays(mt_rand(1,12)),
        	'periodicidadActividadesGrupos' => Str::random(10),
        	'notasActividadesGrupos' => Str::random(100),
        	'precioActividadesGrupos' => mt_rand(50, 400),
        	'politicasCancelacionActividades' => Str::random(50),
        	'esActivo' => 1,
        	'creadoPor' => Str::random(10),
        	'editadoPor' => Str::random(10),


        ]);
    }
}
