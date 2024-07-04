<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            [
                'rut' => '33333333',
                'nombre' => 'Juan Perez',
                'email' => 'juan.perez@example.com',
                'telefono' => '912345678',
            ],
            [
                'rut' => '444444444',
                'nombre' => 'Maria Gomez',
                'email' => 'maria.gomez@example.com',
                'telefono' => '987654321',
            ],
        ]);
    }
}
