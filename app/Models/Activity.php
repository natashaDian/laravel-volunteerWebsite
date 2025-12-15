<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityRegistration;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'title',
        'description',
        'location',
        'start_date',
        'quota',
        'company_code',
    ];

    public function registrations()
    {
        return $this->hasMany(ActivityRegistration::class, 'activity_id');
    }
}
