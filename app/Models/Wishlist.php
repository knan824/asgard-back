<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable=[
        'game_id',
        'user_id',
    ];

    public function games()
    {
        $this->belongsToMany(Game::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
