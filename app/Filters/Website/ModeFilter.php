<?php

namespace App\Filters\Admin;

class ModeFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }
}
