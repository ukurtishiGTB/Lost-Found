<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $lostItems = \App\Models\Item::where('status', 'lost')->latest()->take(6)->get();
    $foundItems = \App\Models\Item::where('status', 'found')->latest()->take(6)->get();
    return view('dashboard', compact('lostItems', 'foundItems'));
})->name('dashboard');

// Item routes
Route::get('/items/lost', [ItemController::class, 'lost'])->name('items.lost');
Route::get('/items/found', [ItemController::class, 'found'])->name('items.found');
Route::get('/items/{item}/report-found', [ItemController::class, 'reportFound'])->name('items.report-found');
Route::patch('/items/{item}/mark-found', [ItemController::class, 'markFound'])->name('items.mark-found');
Route::post('items/{item}/claim', [ClaimController::class, 'store'])->name('claims.store');
Route::resource('items', ItemController::class);
// Admin routes
Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
Route::post('claims/{claim}/verify', [ClaimController::class, 'verify'])->name('claims.verify');

// Profile routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';