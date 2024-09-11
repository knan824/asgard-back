<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform_id',
        'user_id',
    ];

    public function platforms()
    {
        $this->hasMany(Platform::class);
    }

    public function games()
    {
        $this->hasMany(Game::class);
    }
}
