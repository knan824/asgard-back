<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Game extends Model
{
    use HasFactory, Filterable, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'release_year',
        'developer',
        'is_available',
        'is_visible',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    public function modes()
    {
        return $this->belongsToMany(Mode::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'mediable');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }

    public function validAccounts()
    {
        return $this->accounts()->blocked(false)->sold(false)->hasValidUser();
    }

    public function getMainImageAttribute()
    {
        return $this->images()->where('is_main', true)->first();
    }

    public function scopeVisible($query, bool $state = true)
    {
        return $query->where('is_visible', $state);
    }

    public function scopeAvailable($query, bool $state = true)
    {
        return $query->where('is_available', $state);
    }

    public function remove()
    {
        return DB::transaction(function () {
            $this->users()->detach();
            $this->wishlists()->delete();
            $this->images()->delete();
            $this->delete();
        });
    }
}
