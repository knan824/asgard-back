<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
           DB::transaction(function () {
               $this->call([
                   SubscriptionSeeder::class,
                   UserSeeder::class,
                   UserFakeSeeder::class,
                   PlatformSeeder::class,
                   ModeSeeder::class,
                   GameSeeder::class,
                   WishlistSeeder::class,
                   AccountSeeder::class,
               ]);
           });
    }
}
