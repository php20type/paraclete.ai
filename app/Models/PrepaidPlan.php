<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrepaidPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'prepaid_plans';
}
