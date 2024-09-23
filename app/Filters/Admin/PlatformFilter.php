<?php

namespace App\Filters\Admin;

class PlatformFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }

}
