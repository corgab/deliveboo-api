<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;

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

        foreach ($data as $index=>$row) {
            if ($index !== 0) {

                $new_dish = new Dish();

                $new_dish->name = $row[0];
                $new_dish->description_ingredients = $row[1];
                $new_dish->price = $row[2];
                $new_dish->visible = $row[3];
                // Thumb

                // Salvataggio dati 
                $new_dish->save();
            }
        }
    }
}