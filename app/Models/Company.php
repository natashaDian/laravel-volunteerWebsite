<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'companies';

    protected $fillable = [
        'company_code',
        'name',
        'email',
        'password',
        'address',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
