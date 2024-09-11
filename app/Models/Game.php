<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'release_year',
        'developer',
        'mode',
        'is_available',
        'is_visible',
    ];

    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
