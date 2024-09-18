<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        Platform::factory()->count(3)->create();
    }
}
