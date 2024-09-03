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

    public function users()
    {
        $this->belongsToMany(User::class);
    }

    public function wishlist()
    {
        $this->hasMany(Wishlist::class);
    }

    public function platforms()
    {
        $this->hasMany(Platform::class);
    }
}
