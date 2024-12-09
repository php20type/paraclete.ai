<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'subscription_plans';

    /**
     * Plan can have many subscribers
     * 
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscriber::class);
    }
}
