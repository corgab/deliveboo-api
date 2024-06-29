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

        // Recupero Piatti
        $dishes = Dish::all();
         // Data file orders.csv
         $data = $this->getCSVData(__DIR__.'/csv/orders.csv');
         $restaurants = Restaurant::all();


         foreach ($data as $index=>$row) {
            if ($index !== 0) {
                $new_order = new Order();

                $restaurant_ids = $restaurants->random(rand(1, 9))->pluck('id')->all();
                $new_order->restaurant_id = $restaurant_ids;
                $new_order->name = $row[0];
                $new_order->email = $row[1];
                $new_order->number = $row[2];
                $new_order->address = $row[3];
                $new_order->total_price = $row[4];

                // Salvataggio dati 
                $new_order->save();

                // Id randomico di Type in un array
                $dish_ids = $dishes->random(rand(1, 10))->pluck('id')->all();

                // Attach Pivot
                $new_order->dishes()->attach($dish_ids);
            }
        }
    }
}