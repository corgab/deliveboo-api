<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
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

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data file restaurants.csv
        $data = $this->getCSVData(__DIR__.'/csv/restaurants.csv');

        foreach ( $data as $index=>$row) {
            if ($index !== 0) {

                $new_restaurant = new Restaurant();

                $new_restaurant->name = $row[0];
                $new_restaurant->slug = Str::slug($new_restaurant->name, '-');
                $new_restaurant->address = $row[1];
                $new_restaurant->vat = $row[2];
                // Thumb
                // $new_restaurant->thumb = 

                // Salvataggio dati 
                $new_restaurant->save();
            }
        }
    }
}
