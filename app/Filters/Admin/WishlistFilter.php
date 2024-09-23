<?php

namespace App\Filters\Admin;

use App\Filters\QueryFilter;

class WishlistFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->whereHas('game', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        });
    }
}
