<?php

namespace App\Filters\Website;

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

    public function releaseYearFrom($year)
    {
        return $this->builder
            ->where('release_year', '>=', $year)
            ->orderBy('release_year');
    }

    public function developer($keyword)
    {
        return $this->builder->where('developer', 'LIKE', "%{$keyword}%");
    }

    public function modes($keyword)
    {
        return $this->builder->whereHas('modes', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        });
    }

    public function platforms($keyword)
    {
        return $this->builder->whereHas('platforms', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        });
    }
}
