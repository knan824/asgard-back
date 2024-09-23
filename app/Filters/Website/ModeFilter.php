<?php

namespace App\Filters\Website;

use App\Filters\QueryFilter;

class ModeFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }
}
