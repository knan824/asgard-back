<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'user_id',
    ];

    public function users()
    {
        $this->hasMany(User::class);
    }

    public function games()
    {
        $this->hasMany(Game::class);
    }
}
