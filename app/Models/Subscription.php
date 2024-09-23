<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory ,Filterable;

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
        if($this->users()->count()) {
            return false;
        }

        $this->price()->delete();
        $this->users()->detach();
        $this->image()->delete();
        return $this->delete();
    }
}
