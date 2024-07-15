<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class RestaurantController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        if($restaurant){
            $dishes = $restaurant->dishes;
            // $orders = $restaurant->orders()->with('dishes')->paginate(2);
            $orders = $restaurant->orders()->orderBy('created_at', 'desc')->with(['dishes' => function ($query) {
                $query->withPivot('qty');
            }])->paginate(4);
            // dd($orders);
            return view('admin.dashboard', compact('restaurant', 'orders', 'dishes'));
        }else{
            return view('admin.dashboard');
        }
    }
        
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupero l'utente 
        $user = Auth::user();
        // Trova il ristorante associato all'utente
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        
        if ($restaurant) {
            return view('admin.restaurants.index', compact('restaurant'));
        } else {
            $error = 'Nessun ristorante trovato per il tuo account.';
            return view('admin.restaurants.index', compact('error'));
        }
        return view('admin.restaurants.index', compact('restaurant'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Recupero l'utente 
        $user = Auth::user();
        // Trova il ristorante associato all'utente
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        // prendiamo le tipologie
        $types = Type::orderBy('name', 'asc')->get();
        // Controllare se ha già un ristorante registrato
        if($restaurant){
            $user = Auth::user();
            $restaurant = Restaurant::where('user_id', $user->id)->first();
            $orders = $restaurant->orders;
            $dishes = $restaurant->dishes;
            // Imposta un messaggio di errore
            $error = 'Hai già un Ristorante Registrato';
            // Restituisci la vista dell'index
            return view('admin.dashboard', compact('error','restaurant','orders','dishes'));
        }
        // Altrimenti, mostra la vista create
        return view('admin.restaurants.create', compact('user','restaurant', 'types'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {   
        // Validazione
        $form_data = $request->validated();
        // Assegna l'ID dell'utente al campo 'user_id'
        $form_data['user_id'] = $request->input('user_id');
        // Recupera l'utente
        $user = Auth::user();
        // Trova il ristorante associato all'utente
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        // Gestione Slug unico
        $base_slug = Str::slug($form_data['name']);
        $slug = $base_slug;
        $n = 0;
        do {
            $find = Restaurant::where('slug', $slug)->first();
            if ($find !== null) {
                $n++;
                $slug = $base_slug . '-' . $n;
            }
        } while ($find !== null);
        $form_data['slug'] = $slug;

         // Se c'è un'immagine caricata
         if ($request->hasFile('thumb')) {
            $image = $request->file('thumb');

            // Recupero estensione
            $extension = $image->extension();

            // Genero nome file + estensione
            $image_name = $slug . '.' . $extension;

            // Salvo immagine nello storage
            $image_path = $image->storeAs('images/restaurants', $image_name, 'public');
            $form_data['thumb'] = $image_path; // Salvo nel db il Path
        }

        // Creazione nuovo ristorante
        $new_restaurant = Restaurant::create($form_data);
        $new_restaurant->types()->sync($form_data['type_id']);
        return to_route('admin.', $new_restaurant);
    }
    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        // Recupero l'utente 
        $user = Auth::user();
        // Trova il ristorante associato all'utente
        $restaurants = Restaurant::where('user_id', $user->id)->first();
        
        // dd($restaurants);
        return view('admin.restaurants.show', compact('restaurant'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        // Recupero l'utente 
        $user = Auth::user();
        // Trova il ristorante associato all'utente
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        // trova le tipologie
        $types = Type::orderBy('name', 'asc')->get();
        return view('admin.restaurants.edit', compact('restaurant', 'user', 'types'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        // Validazione
        $form_data = $request->validated();
        // Assegna l'ID dell'utente al campo 'user_id'
        $form_data['user_id'] = $request->input('user_id');
        // Recupera l'utente
        $user = Auth::user();
        
        // Trova il ristorante associato all'utente
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        // Gestione Slug unico
        $base_slug = Str::slug($form_data['name']);
        $slug = $base_slug;
        $n = 0;
        do {
            $find = Restaurant::where('slug', $slug)->first();
            if ($find !== null) {
                $n++;
                $slug = $base_slug . '-' . $n;
            }
        } while ($find !== null);
        $form_data['slug'] = $slug;
        if($request->has('type_id')){
            $restaurant->types()->sync($request->type_id);
        }
        else{
            $restaurant->types()->detach();
        }
        // Modifica nuovo ristorante
        $restaurant->update($form_data);
        
        return to_route('admin.restaurants.show', $restaurant);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return to_route('admin.');
    }
}