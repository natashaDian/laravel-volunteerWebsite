<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'name',
        'description',
        'required_points',
        'image_url',
        'is_active',
    ];
}
