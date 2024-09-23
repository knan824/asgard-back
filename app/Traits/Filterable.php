<?php

namespace App\Traits;

use App\Filters\Admin\QueryFilter;

trait Filterable
{
    function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
