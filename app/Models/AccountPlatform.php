<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'platform_id',
    ];
}
