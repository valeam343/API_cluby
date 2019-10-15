<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
use Carbon\CarbonImmutable;
use Carbon\Carbon;
class ProveedoresSuscripcionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedoressuscripciones')->insert([
        	'inicioSuscripcion' => $randomI = Carbon::now()->subMinutes(rand(1, 55)),
        	'finSuscripcion' => $randomF = Carbon::now()->subMinutes(rand(1, 55))->addDays(mt_rand(1,12)),
        	'creadoPor' => Str::random(10),
        	'editadoPor' => Str::random(10),

        ]);
    }
}
