<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehiculos')->insert([
            [
                'tipo_id' => 1,
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'valor_arriendo_diario' => 30000,
                'estado' => 'disponible',
            ],
            [
                'tipo_id' => 2,
                'marca' => 'Honda',
                'modelo' => 'Civic',
                'valor_arriendo_diario' => 35000,
                'estado' => 'disponible',
            ],
            [
                'tipo_id' => 3,
                'marca' => 'Ford',
                'modelo' => 'Explorer',
                'valor_arriendo_diario' => 50000,
                'estado' => 'disponible',
            ],
            [
                'tipo_id' => 4,
                'marca' => 'Chevrolet',
                'modelo' => 'Silverado',
                'valor_arriendo_diario' => 45000,
                'estado' => 'disponible',
            ],
            [
                'tipo_id' => 5,
                'marca' => 'Yamaha',
                'modelo' => 'YZF-R3',
                'valor_arriendo_diario' => 20000,
                'estado' => 'disponible',
            ],
        ]);
    }
}
