<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArriendosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('arriendos')->insert([
            [
                'cliente_rut' => '33333333',
                'vehiculo_id' => 1,
                'user_rut' => '11111111',
                'fecha_inicio' => '2024-07-01',
                'fecha_termino' => '2024-07-07',
                'valor_total' => 210000,
            ],
            [
                'cliente_rut' => '44444444',
                'vehiculo_id' => 2,
                'user_rut' => '22222222',
                'fecha_inicio' => '2024-07-02',
                'fecha_termino' => '2024-07-05',
                'valor_total' => 105000,
            ],
        ]);
    }
}
