<?php

namespace App\Filters\Website;

use App\Filters\QueryFilter;

class AccountFilter extends QueryFilter
{
    public function primary($state)
    {
        return $this->builder->primary($state);
    }

    public function user($user_id)
    {
        return $this->builder->where('user_id', $user_id);
    }

    public function game($keyword)
    {
        return $this->builder->whereHas('games', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        });
    }

    public function platform($id)
    {
        return $this->builder->whereHas('platforms', function ($query) use ($id) {
            $query->where('platform_id', $id);
        });
    }
}
