<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Item routes (without auth)
Route::get('/items/lost', [ItemController::class, 'lost'])->name('items.lost');
Route::get('/items/found', [ItemController::class, 'found'])->name('items.found');
Route::resource('items', ItemController::class);
Route::post('items/{item}/claim', [ClaimController::class, 'store'])->name('claims.store');

// Admin routes (without auth)
Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
Route::post('claims/{claim}/verify', [ClaimController::class, 'verify'])->name('claims.verify');

// Profile routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';