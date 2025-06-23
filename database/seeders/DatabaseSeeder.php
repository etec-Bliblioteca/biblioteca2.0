<?php

namespace Database\Seeders;

use App\Models\Agendamento;
use App\Models\Revista;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RevistaSeeder::class,
            UserSeeder::class,
        ]);
    }
}
