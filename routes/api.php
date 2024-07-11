<?php

use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ROTTE RESTAURANTS
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{restaurant:slug}', [RestaurantController::class, 'show']);

// ROTTE DISHES
Route::get('/dishes', [DishController::class, 'index']);
Route::get('/dishes/{dish:id}', [DishController::class, 'show']);

// ROTTE TYPES
Route::get('/types', [TypeController::class, 'index']);
Route::get('/types/{type:id}', [TypeController::class, 'show']);

// PAYMENTS
Route::post('/checkout', [OrderController::class, 'checkout']);

// EMAIL MESSAGE
Route::post('/contacts', [LeadController::class, 'store']);







