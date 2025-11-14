<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\VehiclePublicController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarModelController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\ProfileController;

Route::get('/', [VehiclePublicController::class, 'index'])->name('public.vehicles.index');
Route::get('/vehicles/{vehicle}', [VehiclePublicController::class, 'show'])->name('public.vehicles.show');

Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('brands', BrandController::class);
    Route::resource('car-models', CarModelController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('vehicles', VehicleController::class);

    Route::get('brands/{brand}/car-models', [CarModelController::class, 'byBrand'])->name('brands.car-models');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.vehicles.index');
})->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
