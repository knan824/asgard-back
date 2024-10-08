<?php

namespace App\Filters\Website;

use App\Filters\QueryFilter;

class AccountUserFilter extends QueryFilter
{
    public function psnEmail($keyword)
    {
        return $this->builder->where('psn_email', 'LIKE', "%{$keyword}%");
    }

    public function sold($state)
    {
        return $this->builder->sold($state);
    }

    public function blocked($state)
    {
        return $this->builder->blocked($state);
    }

    public function primary($state)
    {
        return $this->builder->primary($state);
    }

    public function createdAt($date)
    {
        return $this->builder->whereDate('created_at', $date);
    }

    public function updatedAt($date)
    {
        return $this->builder->whereDate('updated_at', $date);
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
