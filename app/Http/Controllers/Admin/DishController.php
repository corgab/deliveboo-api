<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Type;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupero l'utente 
        $user = Auth::user();

        // Trova il ristorante associato all'utente loggato
        // $restaurant = Restaurant::where('user_id', $user->id)->first();

        // Ristorante dell'utente
        $restaurant = $user->restaurant;

        if ($restaurant) {
            // Prendi tutti i piatti associati
            $dishes = $restaurant->dishes;
            return view('admin.dishes.index', compact('restaurant', 'dishes'));
        }

        return view('admin.dishes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        // Recupero l'utente 
        $user = Auth::user();

        // Ristorante dove user_id è stesso del login
        $restaurant = Restaurant::where('user_id', $user->id)->first();

        //ritorno alla view create
        return view('admin.dishes.create', compact('types', 'restaurant'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
        // Validazione
        $form_data = $request->validated();

        // Assegna l'ID del ristorante al campo 'restaurant_id'
        $form_data['restaurant_id'] = $request->input('restaurant_id');

        // Ottieni l'utente autenticato
        $user = Auth::user();

        // Trova il ristorante associato all'utente autenticato
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        
        // Gestione Slug unico
        $base_slug = Str::slug($form_data['name']);
        $slug = $base_slug;
        $n = 0;
        do {
            $find = Dish::where('slug', $slug)->first();
            if ($find !== null) {
                $n++;
                $slug = $base_slug . '-' . $n;
            }
        } while ($find !== null);
        $form_data['slug'] = $slug;

        // Creazione piatto
        $new_dish = Dish::create($form_data);
        
        return to_route('admin.dishes.show', $new_dish);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {

        // Recupero l'utente 
        $user = Auth::user();

        // Trova il ristorante associato all'utente
        $restaurant = Restaurant::where('user_id', $user->id)->first();

        return view('admin.dishes.edit', compact('dish','restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        // Validazione
        $form_data = $request->validated();

        // Gestione Slug unico
        $base_slug = Str::slug($form_data['name']);
        $slug = $base_slug;
        $n = 0;
        do {
            $find = Dish::where('slug', $slug)->first();
            if ($find !== null) {
                $n++;
                $slug = $base_slug . '-' . $n;
            }
        } while ($find !== null);
        $form_data['slug'] = $slug;

        // Modifica piatto
        $dish->update($form_data);
        
        return to_route('admin.dishes.show', $dish);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        $user = Auth::user();
        $restaurant = $user->restaurant;
        $dishes = $restaurant->dishes;
    
        if ($dish && $dish->restaurant->user_id == $user->id) {
            // Visualizza il piatto
            return view('admin.dishes.show', compact('dish'));
        }
    
        // Reindirizza alla dashboard con un messaggio di errore
        $error = 'Piatto non trovato o accesso negato.';
        return view('admin.dishes.index', compact('error','dishes'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return to_route('admin.dishes.index');
    }
}
