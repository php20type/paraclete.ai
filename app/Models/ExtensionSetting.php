<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtensionSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'extension_settings';

    public $timestamps = false;
}
