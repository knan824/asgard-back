<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'is_yearly',
        'status',
        'expire_at',
    ];

    public function subscriptions()
    {
       $this->hasMany(Subscription::class);
    }

    public function users()
    {
        $this->hasMany(User::class);
    }
}
