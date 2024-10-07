<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Mediable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Mediable;

    protected $fillable = [
        'name',
        'username',
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
        return $this->hasMany(Account::class);
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function remove()
    {
        $this->delete();
    }
}

