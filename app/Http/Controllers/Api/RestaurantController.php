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
        $restaurants = $query->with('types')->paginate(6);

        // Restituisci la lista dei ristoranti come risposta JSON
        return response()->json($restaurants);
    }

    public function show(Restaurant $restaurant)
    {
        // Ottieni i piatti del ristorante con paginazione
        $dishes = $restaurant->dishes()->paginate(2); // Imposta il numero di piatti per pagina
    
        // Aggiungi l'URL completo dell'immagine per ogni piatto e assicurati che tutte le proprietà necessarie siano incluse
        $dishes->getCollection()->transform(function ($dish) {
            if ($dish->thumb) {
                $dish->thumb_url = url('storage/' . $dish->thumb);
            }
            return $dish;
        });
    
        // Manualmente aggiungi i piatti paginati al modello restaurant per mantenerli nella stessa struttura
        $restaurant->setRelation('dishes', $dishes);
    
        return response()->json($restaurant);
    }
    
}