<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform_id',
        'game_id',
    ];
}
