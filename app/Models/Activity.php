<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'company_code',
        'image_url',
    ];

    protected $appends = ['image_src'];

    public function getImageSrcAttribute()
    {
        if ($this->image_url && file_exists(public_path($this->image_url))) {
            return asset($this->image_url);
        }

        return asset('img/default.jpg');
    }

    public function registrations()
    {
        return $this->hasMany(ActivityRegistration::class);
    }
}
