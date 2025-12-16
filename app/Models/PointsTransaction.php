<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'points',
        'source_type',
        'source_id',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
