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

                // Ids dei piatti in un array
                $dish_ids = Dish::all()->pluck('id')->all();
                // Id randomico di dish in un array
                // $dish_ids = $dishes->random(rand(1, 10))->pluck('id')->all();

                // crare una quantità random per i piatti  da inserire negli ordini
                // prendo un piatto random
                $random_dish_id = $faker->randomElements($dish_ids, $faker->numberBetween(1,10));
                // $random_dish_id = random($dish_ids, rand(1,10));
                // per ogni piatto inseriamo una quantità da 0 a 5
                $random_qty = [];

                // Popolo l'array scorrento gli dish generati
                foreach($random_dish_ids as $dish_id) {
                    $random_qty[$dish_id] = ['qty' => rand(1, 4)];
                }  

                

                // Attach Pivot
                $new_order->dishes()->attach($dish_ids);
                // attach qty to dishes
                $new_order->dishes()->attach($random_qty);
            }
        }
    }
}