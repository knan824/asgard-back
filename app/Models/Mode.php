<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
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
