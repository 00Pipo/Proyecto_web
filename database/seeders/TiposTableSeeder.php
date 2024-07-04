<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos')->insert([
            ['nombre' => 'Sedán'],
            ['nombre' => 'Coupé'],
            ['nombre' => 'SUV'],
            ['nombre' => 'Camioneta'],
            ['nombre' => 'Moto'],
        ]);
    }
}
