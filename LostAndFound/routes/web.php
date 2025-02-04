<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $lostItems = \App\Models\Item::where('status', 'lost')->latest()->take(6)->get();
    $foundItems = \App\Models\Item::where('status', 'found')->latest()->take(6)->get();
    return view('dashboard', compact('lostItems', 'foundItems'));
})->name('dashboard');

// Public Item routes
Route::get('/items/lost', [ItemController::class, 'lost'])->name('items.lost');
Route::get('/items/found', [ItemController::class, 'found'])->name('items.found');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items/{item}/report-found', [ItemController::class, 'reportFound'])->name('items.report-found');
Route::patch('/items/{item}/mark-found', [ItemController::class, 'markFound'])->name('items.mark-found');

// Public claim routes
Route::get('/items/{item}/claim', [ClaimController::class, 'create'])->name('items.claim');
Route::post('/items/{item}/claim', [ClaimController::class, 'store'])->name('claims.store');

// Admin claim routes (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
    Route::post('/claims/{claim}/verify', [ClaimController::class, 'verify'])->name('claims.verify');
});

// Admin routes (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/claims', [ClaimController::class, 'index'])->name('claims.index');
    Route::post('/admin/claims/{claim}/verify', [ClaimController::class, 'verify'])->name('claims.verify');
    Route::get('/admin/items', [ItemController::class, 'adminIndex'])->name('admin.items.index');
    Route::delete('/admin/items/{item}', [ItemController::class, 'destroy'])->name('admin.items.destroy');
    // Add these routes in the admin section
    Route::middleware(['auth'])->group(function () {
        Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    });
});

// Authentication routes (for admin only)
require __DIR__.'/auth.php';