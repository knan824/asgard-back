<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function remove()
    {
        $this->price->delete();
        $this->users()->detach();
        $this->delete();
    }
}
