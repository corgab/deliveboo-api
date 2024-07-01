<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants = Restaurant::all(); //paginate
        return response()->json([
            'restaurants' => $restaurants
            // 'success' => true 
            // da valutare se usarlo o meno
         ]);
    }

    public function show(Restaurant $restaurant){

        $restaurant ->load( 'dishes' );

        return response()->json([
            'restaurant' => $restaurant
        ]);
    }
}
