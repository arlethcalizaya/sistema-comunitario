<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'apellido' => 'Sistema',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'rol' => 'administrador'
        ]);

        \App\Models\User::create([
            'name' => 'Maria',
            'apellido' => 'Vecina',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('12345678'),
            'rol' => 'usuario'
        ]);
    }
}
