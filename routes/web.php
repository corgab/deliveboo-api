<?php

use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        
        // Route::get('/', function () {
        //     return view('admin.dashboard');
        // })->name('dashboard');
        Route::get('/', [RestaurantController::class, 'dashboard']);


        // Dishes
        Route::resource('dishes', DishController::class)->only(['index','store','create']);
        Route::get('dishes/{dish:slug}', [DishController::class, 'show'])->name('dishes.show');
        Route::get('dishes/{dish:slug}/edit', [DishController::class, 'edit'])->name('dishes.edit');
        Route::put('dishes/{dish:slug}', [DishController::class, 'update'])->name('dishes.update');
        Route::delete('dishes/{dish:slug}', [DishController::class, 'destroy'])->name('dishes.destroy');
        // Route::delete('dishes/{dish}/permanent-delete', [DishController::class, 'permanentDelete'])->name('dishes.permanentDelete');
        
        // Restaurants
        Route::resource('restaurants', RestaurantController::class)->only(['index','store','create']);
        Route::get('restaurants/{restaurant:slug}', [RestaurantController::class, 'show'])->name('restaurants.show');
        Route::get('restaurants/{restaurant:slug}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
        Route::put('restaurants/{restaurant:slug}', [RestaurantController::class, 'update'])->name('restaurants.update');
        Route::delete('restaurants/{restaurant:slug}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');

        // Types
        Route::resource('types', TypeController::class)->only(['index']);
        Route::get('types/{type:slug}', [TypeController::class, 'show'])->name('types.show');

        // Orders
        Route::resource('orders', OrderController::class)->only(['index']);
        Route::get('orders/orders-statistics', [OrderController::class, 'statistics'])->name('orders.statistics');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
