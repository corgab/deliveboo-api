<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\Dish;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{

    // Funzione recupero dati da CSV
    public function getCSVData(string $path) {
        $data = [];

        $file_stream = fopen($path, 'r');

        if ($file_stream === false) {
            exit('fail' . $path);
        }

        while (($row = fgetcsv($file_stream)) !== false) {
            $data[] = $row;
        }

        fclose($file_stream);

        return $data;
    }

    public function run(Faker $faker): void
    {
        // Data file orders.csv
        $data = $this->getCSVData(__DIR__.'/csv/orders.csv');

        // Recupero dati
        $dishes = Dish::all();
        $restaurants = Restaurant::all();

        foreach ($data as $index=>$row) {
            if ($index !== 0) {

                // Seleziona un ID ristorante casuale dai ristoranti
                $restaurant_id = $restaurants->random()->id;
                
                $new_order = new Order();
                $new_order->restaurant_id = $restaurant_id;
                $new_order->name = $row[0];
                $new_order->email = $row[1];
                $new_order->number = $row[2];
                $new_order->address = $row[3];
                $new_order->total_price = $row[4];

                // Salvataggio dati 
                $new_order->save();

                // Recupera gli ID di tutti i piatti in un array
                $dish_ids = Dish::all()->pluck('id')->all();

                // Genera un array di ID di piatti casuali
                $random_dish_ids = $faker->randomElements($dish_ids, rand(1, 4));

                // Inizializza un array per le quantità dei piatti
                $dish_quantities = [];

                // Popola l'array delle quantità scorrendo gli ID dei piatti generati
                foreach($random_dish_ids as $dish_id) {
                    $dish_quantities[$dish_id] = ['qty' => rand(1, 4)];
                }
                                
                // Associa i piatti
                $new_order->dishes()->attach($dish_quantities);
            }
        }
    }
}