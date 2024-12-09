<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageCredit extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'image_credits';
}
