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
    
        // *** FILTRO PIU TIPOLOGIE ***
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
    
        // Esegui la query e ottieni i risultati paginati con tutte le relazioni
        $restaurants = $query->with('types')->paginate(6);
    
        // Aggiungi l'URL completo dell'immagine per ogni ristorante
        $restaurants->getCollection()->transform(function ($restaurant) {
            if ($restaurant->thumb) {
                $restaurant->thumb_url = url('storage/' . $restaurant->thumb);
            }
            return $restaurant;
        });
    
        // Restituisci la lista dei ristoranti come risposta JSON
        return response()->json($restaurants);
    }

    public function show(Restaurant $restaurant)
    {
        // Ottieni i piatti del ristorante con paginazione
        $dishes = $restaurant->dishes()->paginate(4); // Imposta il numero di piatti per pagina
    
        // Aggiungi l'URL completo dell'immagine per ogni piatto
        $dishes->getCollection()->transform(function ($dish) {
            if ($dish->thumb) {
                $dish->thumb_url = url('storage/' . $dish->thumb);
            }
            return $dish;
        });

         // Aggiungi l'URL completo dell'immagine miniatura del ristorante
        if ($restaurant->thumb) {
            $restaurant->thumb_url = url('storage/' . $restaurant->thumb);
        }

        // Aggiungi i piatti paginati
        $restaurant->setRelation('dishes', $dishes);
    
        return response()->json($restaurant);
    }
    
}