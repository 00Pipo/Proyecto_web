<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'rut' => '11111111',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456789'),
                'perfil_id' => 1,
            ],
            [
                'rut' => '22222222',
                'name' => 'Ejecutivo User',
                'email' => 'ejecutivo@example.com',
                'password' => Hash::make('123456789'),
                'perfil_id' => 2,
            ],
        ]);
    }
}
