<?php

namespace App\Filters;

class ModeFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }
}
