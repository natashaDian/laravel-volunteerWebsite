<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'start_date',
        'end_date',
        'company_code',
        'image_url',
    ];

    protected $appends = ['image_src'];

    public function getImageSrcAttribute()
    {
        if ($this->image_url) {

            if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
                return $this->image_url;
            }

            $path = ltrim($this->image_url, '/');

            if (!str_contains($path, '/')) {
                $path = 'img/' . $path;
            }

            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }

        return asset('img/default.jpg');
    }

    public function registrations()
    {
        return $this->hasMany(ActivityRegistration::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_code', 'company_code');
    }
}
