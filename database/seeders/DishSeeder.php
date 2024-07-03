<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Dish;
use App\Models\Restaurant;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
    **/


    // Funzione recupero dati da CSV
    public function getCSVData(string $path)
    {
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


    public function run(): void
    {
        // Data file dishes.csv
        $data = $this->getCSVData(__DIR__.'/csv/dishes.csv');

        // Recupero data
        $restaurants = Restaurant::all();

        foreach ($data as $index=>$row) {
            if ($index !== 0) {

                $restaurant_id = $restaurants->random()->id;

                $new_dish = new Dish();

                $new_dish->restaurant_id = $restaurant_id;
                $new_dish->name = $row[0];
                $new_dish->slug = Str::slug($new_dish->name, '-');
                $new_dish->description_ingredients = $row[1];
                $new_dish->price = $row[2];
                $new_dish->visible = $row[3];
                $new_dish->thumb = $row[4];

                
                // Salvataggio dati 
                $new_dish->save();


            }
        }
    }
}
