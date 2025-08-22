<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
use App\Models\Car;


class BookingController extends Controller
{
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:cars,id',
            'client_name' => 'required|string|max:255',
            'cnic' => 'required|regex:/^\d{5}-\d{7}-\d{1}$/',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:18',
            'days' => 'required|integer|min:1',
            'driving_license' => 'required|boolean',
            'total_amount' => 'required|numeric',
        ]);

        $validated['driving_license'] = $request->has('driving_license') ? 1 : 0;

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the booking
        $booking = Booking::create($request->except('_token'));


        // Redirect to payment page
        return redirect()->route('Rentalcars');
    }


    public function index()
    {
        $bookings = Booking::latest()->get();
        return view('admin.clients', compact('bookings'));
    }

     public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('clients')->with('success', 'Booking deleted successfully.');
    }
}
