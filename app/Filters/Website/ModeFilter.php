<?php

namespace App\Filters\Website;

use App\Filters\QueryFilter;

class ModeFilter extends QueryFilter
{
    public function name($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }
}
