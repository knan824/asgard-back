<?php

namespace App\Filters\Website;

use App\Filters\QueryFilter;

class SubscriptionFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }

}
