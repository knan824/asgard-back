<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'priceable_id',
        'priceable_type',
    ];

    public function priceable()
    {
        return $this->morphTo();
    }
}
