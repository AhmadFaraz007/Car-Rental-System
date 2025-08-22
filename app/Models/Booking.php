<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
    'car_id',
    'client_name',
    'cnic',
    'gender',
    'age',
    'days',
    'driving_license',
    'total_amount',
    'status',
];
protected $casts = [
    'driving_license' => 'boolean',
];
}
