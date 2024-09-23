<?php

namespace App\Filters\Admin;

class WishlistFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->whereHas('game', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        });
    }
}
