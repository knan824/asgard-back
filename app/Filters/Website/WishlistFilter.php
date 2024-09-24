<?php

namespace App\Filters\Website;

use App\Filters\QueryFilter;

class WishlistFilter extends QueryFilter
{
    public function game($keyword)
    {
        return $this->builder->whereHas('game', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        });
    }
}
