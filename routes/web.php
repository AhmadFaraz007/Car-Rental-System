<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalCarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\BlogController;


Route::get('/', function () {
    return view('home');
});
Route::get('/Rentalcars', [RentalCarController::class, 'index'])->name('Rentalcars');
Route::get('/FAQs', function () {
    return view('FAQs');
});
Route::get('/contact', function () {
    return view('contact_us');
});
Route::get('/about', function () {
    return view('about_us');
});







Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




// ----------------------------------Admin/Cars-Routes-------------------------------------------------------------------
Route::get('/cars', [CarController::class, 'index'])->middleware(['auth', 'verified'])->name('cars');
Route::post('/cars', [CarController::class, 'store'])->middleware(['auth', 'verified'])->name('cars.store');
Route::put('/cars/{car}', [CarController::class, 'update'])->middleware(['auth', 'verified'])->name('cars.update');
Route::delete('/cars/{id}', [CarController::class, 'destroy'])->middleware(['auth', 'verified'])->name('cars.destroy');
// ---------------------------------------------------------------------------------------------------------------------

//-----------------------------------Admin/Clients-Routes---------------------------------------------------------------
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/clients', [BookingController::class, 'index'])->middleware(['auth', 'verified'])->name('clients');
Route::delete('/clients/{client}', [BookingController::class, 'destroy'])->name('client.destroy');
// ---------------------------------------------------------------------------------------------------------------------

Route::post('/send-message', [MessageController::class, 'store'])->name('message.store');
Route::prefix('messages')->group(function () {
    Route::get('/', [MessageController::class, 'index'])->middleware(['auth', 'verified'])->name('messages.index');
    Route::get('/{message}', [MessageController::class, 'show'])->middleware(['auth', 'verified'])->name('messages.show');
    Route::delete('/{message}', [MessageController::class, 'destroy'])->middleware(['auth', 'verified'])->name('messages.destroy');
});

// Blog Routes
Route::get('/blogs', [BlogController::class, 'index'])->middleware(['auth', 'verified'])->name('blogs.index');
Route::post('/blogs/store', [BlogController::class, 'store'])
     ->middleware(['auth', 'verified'])
     ->name('blogs.store');
Route::put('/blogs/{id}', [BlogController::class, 'update'])
     ->middleware(['auth', 'verified'])
     ->name('blogs.update');
Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])
     ->middleware(['auth', 'verified'])
     ->name('blogs.destroy');


Route::get('/blogsPage', [BlogController::class, 'index_2'])->name('blogPage.index_2');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
