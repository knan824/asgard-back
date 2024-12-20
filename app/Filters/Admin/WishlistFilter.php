<?php

namespace App\Filters\Admin;

use App\Filters\QueryFilter;

class WishlistFilter extends QueryFilter
{
    public function game($keyword)
    {
        return $this->builder->whereHas('game', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        });
    }

    public function user($userId)
    {
        return $this->builder->where('user_id', $userId);
    }
}
