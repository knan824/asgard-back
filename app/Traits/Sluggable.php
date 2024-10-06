<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value) . '-' . random_int(100000, 999999);
    }
}
