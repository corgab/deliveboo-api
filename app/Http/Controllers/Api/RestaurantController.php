<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        // Estrae il parametro 'types' dalla query string
        $types = $request->query('types');

        // Inizializza la query base
        $query = Restaurant::query();

        // Se i tipi sono presenti, filtra i ristoranti
        if ($types) {
            $typesArray = explode(',', $types);

            $query->whereHas('types', function ($q) use ($typesArray) {
                $q->whereIn('name', $typesArray);
            });
        }

        // Esegui la query e ottieni i risultati
        $restaurants = $query->with('types')->get();

        // Restituisci la lista dei ristoranti come risposta JSON
        return response()->json($restaurants);
    }

    public function show(Restaurant $restaurant){
        $restaurant ->load( 'dishes', 'types');
        return response()->json([
            'restaurant' => $restaurant
        ]);
    }
}