<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wishlist::factory()
            ->count(10)
            ->recycle(User::all())
            ->recycle(Game::all())
            ->create();
    }
}
