<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'rent_price' => 'required|numeric',
        'description' => 'required|string',
        'image_link' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'owner_name' => 'required|string|max:255',
        'owner_contact' => 'required|string'
    ]);

    $car = new Car();
    $car->name = $request->name;
    $car->model = $request->model;
    $car->rent_price = $request->rent_price;
    $car->description = $request->description;
    $car->owner_name = $request->owner_name;
    $car->owner_cantact = $request->owner_contact;

    if ($request->hasFile('image_link')) {
    $image = $request->file('image_link');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('uploads'), $imageName);
} else {
    $imageName = null;
}

$car = Car::create([
    'name' => $request->name,
    'model' => $request->model,
    'rent_price' => $request->rent_price,
    'description' => $request->description,
    'image_link' => 'uploads/' . $imageName,
    'owner_name' => $request->owner_name,
    'owner_contact' => $request->owner_contact,
]);

return response()->json($car);


}


    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $car = Car::findOrFail($id);

            $car->name = $request->name;
            $car->model = $request->model;
            $car->rent_price = $request->rent_price;
            $car->description = $request->description;
            $car->owner_name = $request->owner_name;
            $car->owner_contact = $request->owner_contact;

            if ($request->hasFile('image_link')) {
                $image = $request->file('image_link');
                $imagePath = $image->store('cars', 'public');
                $car->image_link = 'storage/' . $imagePath;
            }

            $car->save();

            return response()->json($car);
        } catch (\Exception $e) {
            \Log::error('Update failed: '.$e->getMessage());
            return response()->json(['error' => 'Update failed'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return response()->json(['success' => true]);
    }
}
