<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Vendor\VendorProductController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('vendor')->middleware('role:vendor')->group(function () {
        Route::resource('products', VendorProductController::class);
    });

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('products', [AdminProductController::class, 'index']);
        Route::post('products/{product}/approve', [AdminProductController::class, 'approve']);
        Route::post('products/{product}/reject', [AdminProductController::class, 'reject']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
