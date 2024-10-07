<?php

namespace App\Models;

use App\Traits\Mediable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes, Mediable;

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
        return $this->BelongsTo(User::class)->withTrashed();
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = encrypt($password);
    }

    public function getPasswordAttribute(string $password)
    {
        return decrypt($password);
    }

    public function scopeBlocked($query, $blocked = true)
    {
        return $query->where('is_blocked', $blocked);
    }

    public function scopeSold($query, $sold = true)
    {
        return $query->where('is_sold', false);
    }

    public function scopeHasValidUser($query)
    {
        return $query->whereHas('user', function ($query) {
            $query->whereNull('deleted_at')->where('is_blocked', false);
        });
    }

    public function belongsToLoggedUser(User $user): bool
    {
        return $this->user_id !== auth()->id() && $this->user_id !== $user->id || $this->is_blocked;
    }

    public function remove()
    {
        return $this->delete();
    }
}
