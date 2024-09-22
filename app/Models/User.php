<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'mediable');
    }
}

