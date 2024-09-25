<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Game;
use App\Models\Platform;
use App\Models\Price;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = Account::factory()->count(20)
            ->recycle(User::all())
            ->has(Price::factory())
            ->create();

        $accounts->each(function ($account) {
            $account->platforms()->attach(Platform::inRandomOrder()->first());
            $account->games()->attach(Game::inRandomOrder()->first());
        });
    }
}
