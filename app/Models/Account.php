<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'psn_email',
        'password',
        'platform_type',
        'is_sold',
        'is_blocked',
        'is_primary',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    public function price()
    {
        return $this->morphOne(Price::class, 'priceable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'mediable');
    }

    public function remove()
    {
        $this->user()->detach();
        $this->games()->detach();
        $this->platforms()->detach();
        $this->price()->delete();
        $this->images()->delete();
        $this->delete();
    }
}
