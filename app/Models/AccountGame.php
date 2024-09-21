<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'game_id',
    ];
}
