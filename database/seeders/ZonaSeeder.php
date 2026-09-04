<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Zona::create(['nombre' => 'Zona Norte']);
        \App\Models\Zona::create(['nombre' => 'Zona Sur']);
        \App\Models\Zona::create(['nombre' => 'Centro']);
    }
}
