<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class RentalCarController extends Controller
{
    public function index(){
        $cars = Car::all();
        return view('rentalCars',compact('cars'));
    }
}
