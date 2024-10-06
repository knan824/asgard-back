<?php

namespace App\Filters\Admin;

use App\Filters\QueryFilter;

class SubscriptionFilter extends QueryFilter
{
    public function name($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }
}
