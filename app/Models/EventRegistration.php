<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EventRegistration extends Model
{
    use HasFactory;

    protected $table = 'event_registrations';
    protected $fillable = [
        'regist_code',
        'event_id',
        'user_id',
        'status',
        'is_confirmed',
        'confirmed_at',
    ];
}
