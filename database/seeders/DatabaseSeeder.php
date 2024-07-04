<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PerfilesTableSeeder::class,
            UsersTableSeeder::class,
            TiposTableSeeder::class,
            VehiculosTableSeeder::class,
            ClientesTableSeeder::class,
            ArriendosTableSeeder::class,
        ]);
    }
}
