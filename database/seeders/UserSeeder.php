<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(10)->create();

        $users->each(function ($user) {
            $user->subscriptions()->attach(Subscription::inRandomOrder()->first(), [
                'status' => 'active',
                'expire_at' => now()->addMonth(),
            ]);
        });
    }
}
