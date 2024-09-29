<?php

namespace App\Filters\Admin;

use App\Filters\QueryFilter;

class GameFilter extends QueryFilter
{
    public function name($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }

    public function year($keyword)
    {
        return $this->builder->where('release_year', 'LIKE', "%{$keyword}%");
    }

    public function developer($keyword)
    {
        return $this->builder->where('developer', 'LIKE', "%{$keyword}%");
    }

    public function mode($keyword)
    {
        return $this->builder->whereHas('modes', function ($query) use ($keyword) {
            $query->where('id', 'LIKE', "%{$keyword}%");
        });
    }

    public function platforms($keyword)
    {
        return $this->builder->whereHas('platforms', function ($query) use ($keyword) {
            $query->where('id', 'LIKE', "%{$keyword}%");
        });
    }

    public function releaseYearFrom($year)
    {
        return $this->builder
                ->where('release_year', '>=', $year)
                ->orderBy('release_year');
    }

    public function createdAt($date)
    {
        return $this->builder->whereDate('created_at', $date);
    }

    public function available($state)
    {
        return $this->builder->available($state);
    }

    public function visible($state)
    {
        return $this->builder->visible($state);
    }
}