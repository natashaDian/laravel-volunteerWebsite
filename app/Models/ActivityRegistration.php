<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityRegistration extends Model
{
    protected $table = 'activity_registrations';

    protected $fillable = [
        'activity_id',
        'user_id',
    ];
}