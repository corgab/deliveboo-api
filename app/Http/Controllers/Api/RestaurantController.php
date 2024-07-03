<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
        {
            // passaggio parametri
            $types = $request->query('types');
            
            // Se i tipi sono presenti, filtrali
            if ($types) {
                $typesArray = explode(',', $types);
                $ristoranti = Ristorante::whereIn('type', $typesArray)->get();
            } else {
                // Altrimenti restituisci tutti i ristoranti
                $ristoranti = Ristorante::all();
            }
    
            return response()->json($ristoranti);
        }

    public function show(Restaurant $restaurant){

        $restaurant ->load( 'dishes' );

        return response()->json([
            'restaurant' => $restaurant
        ]);
    }
}
