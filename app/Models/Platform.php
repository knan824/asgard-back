<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Mediable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Platform extends Model
{
    use HasFactory, Filterable, Sluggable, Mediable;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function games()
    {
        $this->belongsToMany(Game::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }

    public function remove()
    {
        return DB::transaction(function () {
            $this->removeMedia();
            $this->delete();
        });
    }
}
