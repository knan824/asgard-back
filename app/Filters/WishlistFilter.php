<?php

namespace App\Filters;

class WishlistFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->whereHas('game', function ($query) use ($keyword) { //search based on game name
            $query->where('name', 'LIKE', "%{$keyword}%");
        });
    }
}
