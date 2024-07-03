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
        // Se i tipi sono presenti, filtra i ristoranti
        if ($types) {
            $typesArray = explode(',', $types);
            // Trova gli ID dei tipi corrispondenti ai nomi
            $typeIds = Type::whereIn('name', $typesArray)->pluck('id')->toArray();
            // Filtra i ristoranti che hanno i tipi specificati
            $restaurants = Restaurant::whereHas('types', function($query) use ($typeIds) {
                $query->whereIn('types.id', $typeIds);
            })->get();
        } else {
            // Altrimenti restituisci tutti i ristoranti
            $restaurants = Restaurant::all();
        }
        // Restituisci la lista dei ristoranti come risposta JSON
        return response()->json($restaurants);
    }
    public function show(Restaurant $restaurant){
        $restaurant ->load( 'dishes' );
        return response()->json([
            'restaurant' => $restaurant
        ]);
    }
}