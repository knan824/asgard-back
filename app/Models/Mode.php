<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    use HasFactory, Filterable, Sluggable;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function remove()
    {
        if ($this->games()->count()) {
            return false;
        }

        return $this->delete();
    }
}
