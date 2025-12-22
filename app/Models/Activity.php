<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'activity_id',
        'title',
        'description',
        'image_url',
        'start_date',
        'end_date',
        'category',
        'location',
        'quota',
        'company_code',
    ];

    protected $appends = ['image_src'];

    public function getImageSrcAttribute()
    {
        if (!$this->image_url) {
            return asset('images/default.jpg');
        }

        if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
            return $this->image_url;
        }

        return asset($this->image_url);
    }

    public function registrations()
    {
        return $this->hasMany(ActivityRegistration::class);
    }
}
