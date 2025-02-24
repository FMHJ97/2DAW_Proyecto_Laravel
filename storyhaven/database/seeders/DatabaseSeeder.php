<?php

namespace Database\Seeders;

use App\Models\Genero;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*
        Insertamos un usuario administrador.
        */
        User::factory()->create([
            'name' => 'Francisco Manuel',
            'surname' => 'Hernández',
            'date_birth' => '1997-01-05',
            'country' => 'España',
            'username' => 'admin123',
            'email' => 'admin123@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('123456789'),
        ]);

        /*
        Insertamos los géneros literarios.
        Con insert se insertan todos los registros en una sola consulta SQL.
        No se incluirán los timestamps porque no se requiere saber cuándo se creó o actualizó un género.
        */
        Genero::insert([
            ['nombre' => 'Acción'],
            ['nombre' => 'Aventura'],
            ['nombre' => 'Ciencia ficción'],
            ['nombre' => 'Fantasía'],
            ['nombre' => 'Misterio'],
            ['nombre' => 'Romance'],
            ['nombre' => 'Terror'],
            ['nombre' => 'Thriller'],
            ['nombre' => 'Drama'],
            ['nombre' => 'Comedia'],
            ['nombre' => 'Crimen'],
            ['nombre' => 'Suspense'],
            ['nombre' => 'No ficción'],
            ['nombre' => 'Histórico'],
            ['nombre' => 'Sobrenatural'],
            ['nombre' => 'Psicológico'],
            ['nombre' => 'Distopía'],
            ['nombre' => 'Post-apocalíptico'],
        ]);

    }
}
