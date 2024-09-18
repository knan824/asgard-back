<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'is_main',
        'extension',
        'size',
        'type'
    ];

    protected $casts = [
        'is_main' => 'boolean'
    ];

    public function mediable()
    {
        return $this->morphTo();
    }
}
