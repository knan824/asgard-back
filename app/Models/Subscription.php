<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Mediable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{
    use HasFactory, Filterable, Sluggable, Mediable;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function price()
    {
        return $this->morphOne(Price::class, 'priceable');
    }

    public function remove()
    {
        if ($this->users()->count()) {
            return false;
        }

        return DB::transaction(function () {
            $this->price()->delete();
            $this->users()->detach();
            $this->removeMedia();
            return $this->delete();
        });
    }
}
