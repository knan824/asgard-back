<?php

namespace App\Filters\Admin;

class SubscriptionFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }

}
