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
        'price',
        'platform',
        'is_available',
        'is_visible',
    ];

    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    public function users()
    {
        $this->belongsToMany(User::class);
    }

    public function wishlist()
    {
        $this->hasMany(Wishlist::class);
    }
}
