<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {   
        // Validazione
        $form_data = $request->validated();

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

        // Creazione nuovo ristorante
        $new_restaurant = Restaurant::create($form_data);
        
        return to_route('admin.restaurants.index', $new_restaurant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {

        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {

        // dd($restaurant);
        return view('admin.restaurants.edit',compact('restaurant'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        // Validazione
        $form_data = $request->validated();

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

        // Modifica nuovo ristorante
        $restaurant->update($form_data);
        
        return to_route('admin.restaurants.show', $restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
