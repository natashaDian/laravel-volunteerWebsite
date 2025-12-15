<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityRegistration extends Model
{
    protected $fillable = [
        'activity_id',
        'user_id',
        'motivation',
        'phone',
        'status',
        'confirmation_code'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
