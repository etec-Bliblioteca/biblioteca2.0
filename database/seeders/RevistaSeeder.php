<?php

namespace Database\Seeders;

use App\Models\Revista;
use Database\Factories\RevistaFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RevistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Revista::factory()->count(20)->create();
    }
}
