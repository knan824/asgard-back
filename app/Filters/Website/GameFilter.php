<?php

namespace App\Filters\Admin;

class GameFilter extends QueryFilter
{
    public function search($keyword)
    {
        return $this->builder->where('name', 'LIKE', "%{$keyword}%");
    }

    public function year($keyword) //from date
    {
        return $this->builder->where('release_year', 'LIKE', "%{$keyword}%");
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

    public function available($state)
    {
        return $this->builder->available($state);
    }

    public function visible($state)
    {
        return $this->builder->visible($state);
    }
}
