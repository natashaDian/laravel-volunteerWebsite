<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = [
        'event_code',
        'company_id',
        'title',
        'description',
        'location',
        'date',
        'time',
        'quota',
    ];

     public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
