<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index(){
        $dishes = Dish::with('restaurant')->get(); //paginate
        return response()->json([
            'dishes' => $dishes
            // 'success' => true 
            // da valutare se usarlo o meno
         ]); 
    }

    public function show(Dish $dish){

        $dish ->load( 'restaurant' );
        
        return response()->json([
            'dish' => $dish
        ]);
    }
}
