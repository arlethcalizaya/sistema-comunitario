<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Categoria::create(['nombre' => 'Baches', 'descripcion' => 'Problemas en el asfalto']);
        \App\Models\Categoria::create(['nombre' => 'Basura', 'descripcion' => 'Acumulación de residuos']);
        \App\Models\Categoria::create(['nombre' => 'Alumbrado', 'descripcion' => 'Luces de calle apagadas']);
    }
}
