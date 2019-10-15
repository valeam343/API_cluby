<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
// And the CarbonImmutable class
use Carbon\CarbonImmutable;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('actividades')->insert([
        	'nomActividad' => Str::random(10),
        	'desActividad' => Str::random(10),
        	'edadMinimaActividad' => mt_rand(1,15),
        	'edadMaximaActividad' => mt_rand(1,15),
        	'reqsActividad' => Str::random(10),
        	'referenciaPrecioActividad' => mt_rand(50,300),
        	'keywordsActividad' => str::random(10),
        	'creadoPor' => str::random(10),
        	'editadoPor' => str::random(10),

        ]);
    }
}
