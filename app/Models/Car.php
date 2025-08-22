<?php

namespace App\Models;
use App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
    'name', 'model', 'rent_price', 'description', 'image_link','owner_name','owner_contact'
];

public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
