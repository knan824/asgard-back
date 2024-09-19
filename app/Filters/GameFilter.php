<?php

namespace App\Filters;

class GameFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }

    public function visible($state)
    {
        return $this->builder->visible($state);
    }
}
