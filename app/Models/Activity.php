<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{   
    protected $table = 'activities';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'start_date',
        'end_date',
        'category',
        'organizer', // Jika ada kolom organizer
        'type',      // Jika ada kolom type (Event/Project)
        'location',  // Jika ada kolom location
        'registration_deadline', // Jika ada kolom deadline registrasi
    ];

    protected $casts = [
        'start_date' => 'date', 
        'end_date' => 'date',
        'registration_deadline' => 'date', 
    ];
}
