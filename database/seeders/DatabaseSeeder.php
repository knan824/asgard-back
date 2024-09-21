<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            SubscriptionSeeder::class,
            UserSeeder::class,
            PlatformSeeder::class,
            ModeSeeder::class,
            GameSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}
