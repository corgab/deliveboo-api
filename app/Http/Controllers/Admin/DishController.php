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
use Illuminate\Pagination\Paginator;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupero l'utente 
        $user = Auth::user();

        // Ristorante dell'utente
        $restaurant = $user->restaurant;

        if ($restaurant) {
            // Prendi tutti i piatti associati
            $dishes = $restaurant->dishes()->paginate(6);
            // $dishes_deleted = Dish::withTrashed()->where('restaurant_id', $restaurant->id)->get();
            return view('admin.dishes.index', compact('restaurant', 'dishes')); // dishes_deleted
        }

        return view('admin.dishes.index', compact('restaurant'));
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
    
        // Ottieni l'utente autenticato
        $user = Auth::user();
    
        // Trova il ristorante associato all'utente autenticato
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        $form_data['restaurant_id'] = $restaurant->id;
    
        // Gestione Slug unico
        $base_slug = Str::slug($form_data['name']);
        $slug = $base_slug;
        $n = 0;
        do {
            $find = Dish::withTrashed()->where('slug', $slug)->first();
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
            $image_path = $image->storeAs('images/dishes', $image_name, 'public');
            $form_data['thumb'] = $image_path; // Salvo nel db il Path
        }
        
        // Creazione piatto
        $new_dish = Dish::create($form_data);
        
        return to_route('admin.dishes.index', $new_dish);
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
            if ($find !== null && $find->id !== $dish->id) {
                $n++;
                $slug = $base_slug . '-' . $n;
            }
        } while ($find !== null && $find->id !== $dish->id);
        $form_data['slug'] = $slug;
    
        // Rimuove l'immagine
        if ($request->has('remove_image') && $request->remove_image == 1) {
            if ($dish->thumb && \Storage::disk('public')->exists($dish->thumb)) {
                \Storage::disk('public')->delete($dish->thumb);
            }
            $form_data['thumb'] = null;
        } 
        // Se c'è un'immagine caricata
        elseif ($request->hasFile('thumb')) {
            $image = $request->file('thumb');

            // Recupero estensione
            $extension = $image->extension();

            // Genero nome file + estensione
            $image_name = $slug . '.' . $extension;

            // Salvo immagine nello storage
            $image_path = $image->storeAs('images/dishes', $image_name, 'public');
            $form_data['thumb'] = 'images/dishes/' . $image_name; // Salvo nel db il Path completo

            // Rimuovo l'immagine precedente 
            if ($dish->thumb && \Storage::disk('public')->exists($dish->thumb)) {
                \Storage::disk('public')->delete($dish->thumb);
            }
        }
    
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
        
        if ($restaurant !== null) {
            
            $dishes = $restaurant->dishes;
        }
    
        if ($dish && $dish->restaurant->user_id == $user->id) {
            // Visualizza il piatto
            return view('admin.dishes.show', compact('dish'));
        }
    
        // Reindirizza alla dashboard con un messaggio di errore
        $error = 'Piatto non trovato o accesso negato.';
        return view('admin.dishes.index', compact('error'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return to_route('admin.dishes.index');
    }

    // public function permanentDelete(Dish $dish)
    // {
    //     // Controlla se l'immagine esiste e la elimina
    //     if ($dish->thumb && \Storage::disk('public')->exists($dish->thumb)) {
    //         \Storage::disk('public')->delete($dish->thumb);
    //     }

    //     // Elimina definitivamente il piatto
    //     $dish->forceDelete();

    //     return redirect()->route('admin.dishes.index')->with('success', 'Piatto eliminato definitivamente');
    // }
}
