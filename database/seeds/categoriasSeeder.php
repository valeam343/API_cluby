<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class categoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
        	'nomCategoria' => Str::random(10),
        	'descCategoria' => Str::random(30),
        	'esActivo' => 1,
        	'creadoPor' => Str::random(10),
        	'editadoPor' => Str::random(10),
        ]);
    }
}
