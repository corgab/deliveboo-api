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

        // *** FILTRO SINGOLA TIPOLOGIA***
        // if ($types) {
        //     $typesArray = explode(',', $types); //fai l'array dei tipi di ristorante

        //     $query->whereHas('types', function ($q) use ($typesArray) {
        //         $q->whereIn('name', $typesArray);
        //     });
        // }


        // *** FILTRO PIU TIPOLOGIE***
        if ($types) {
            $typesArray = explode(',', $types);
            foreach ($typesArray as $typeName) {
                $typeId = Type::where('name', $typeName)->pluck('id')->first();
                if ($typeId) {
                    $query->whereHas('types', function ($q) use ($typeId) {
                        $q->where('types.id', $typeId);
                    });
                }
            }
        }
        // Esegui la query e ottieni i risultati
        $restaurants = $query->with('types')->get();

        // Restituisci la lista dei ristoranti come risposta JSON
        return response()->json($restaurants);
    }

    public function show(Restaurant $restaurant)
    {
        // Carica i ristoranti con i piatti
        $restaurant->load(['dishes']);

        // Aggiungi l'URL completo dell'immagine per ogni piatto
        $dishes = $restaurant->dishes->map(function ($dish) {
            if ($dish->thumb) {
                $dish->thumb_url = url('storage/' . $dish->thumb);
            }
            return $dish;
        });

        return response()->json([
            'restaurant' => $restaurant,
            'dishes' => $dishes
        ]);
    }
}