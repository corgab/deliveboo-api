<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('dishes', 'restaurant')->get(); //paginate
        return response()->json([
            'orders' => $orders
            // 'success' => true 
            // da valutare se usarlo o meno
         ]); 
    }

    public function show(Order $order){

        $order ->load( 'dishes','restaurant' );

        return response()->json([
            'order' => $order
        ]);
    }
}
