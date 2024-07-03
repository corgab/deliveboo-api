<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $restaurant = $user->restaurant;

        if ($restaurant) {
            $orders = $restaurant->orders;
            return view('admin.orders.index', compact('restaurant', 'orders'));
        }
        return view('admin.orders.index');
    }

    public function statistics(){
        return view('admin.orders.orders-statistics');
    }
}
