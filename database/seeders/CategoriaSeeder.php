<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            [
                'descripcion' => 'Cliente'
            ],
            [
                'descripcion' => 'Proveedor'
            ],
            [
                'descripcion' => 'Funcionario Interno'
            ]
        ]);
    }
}
