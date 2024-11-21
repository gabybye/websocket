<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/chat', function () {
    $id = Auth::user()->id; // Assuming you want to use the authenticated user's ID
    $messengerColor = config('chatify.color'); // Example configuration value
    $dark_mode = config('chatify.ligth_mode'); // Example configuration value

    return view('vendor.Chatify.pages.app', compact('id', 'messengerColor', 'dark_mode'));
})->middleware('auth')->name('chat');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
