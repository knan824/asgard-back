<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function price()
    {
        return $this->morphOne(Price::class, 'priceable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'mediable');
    }

    public function remove()
    {
        return DB::transaction(function () {
            if ($this->users()->count()) {
                return false;
            }

            $this->price()->delete();
            $this->users()->detach();
            $this->image()->delete();
            return $this->delete();
        });
    }
}
