<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function games()
    {
        $this->belongsToMany(GamePlatform::class);
    }
}
