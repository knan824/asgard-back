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
        'is_sold',
        'is_blocked',
        'is_primary',
    ];

    protected $casts = [
        'is_sold' => 'boolean',
        'is_blocked' => 'boolean',
        'is_primary' => 'boolean',
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

    public function image()
    {
        return $this->morphOne(Image::class, 'mediable');
    }

    public function scopeBlocked($query, $blocked = true)
    {
        return $query->where('is_blocked', $blocked);
    }

    public function remove()
    {
        $this->games()->detach();
        $this->platforms()->detach();
        $this->price()->delete();
        $this->image()->delete();
        $this->delete();
    }
}
