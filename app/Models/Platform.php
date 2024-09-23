<?php

namespace App\Models;


use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Platform extends Model
{
    use HasFactory, Filterable;



    protected $fillable = [
        'name'
    ];

    public function games()
    {
        $this->belongsToMany(Game::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'mediable');
    }

    public function remove()
    {
        $this->image()->delete();
        $this->delete();
    }
}
