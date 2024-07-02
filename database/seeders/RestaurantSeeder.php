<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;

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

        // Recupero data
        $types = Type::all();

        foreach ( $data as $index=>$row) {
            if ($index !== 0) {

                // Id_user seguendo index
                $user_id = $index;

                $new_restaurant = new Restaurant();

                $new_restaurant->user_id = $user_id;
                $new_restaurant->name = $row[0];
                $new_restaurant->slug = Str::slug($new_restaurant->name, '-');
                $new_restaurant->address = $row[1];
                $new_restaurant->vat = $row[2];
                // Thumb

                // Salvataggio dati
                $new_restaurant->save();

                // Id randomico di Type in un array
                $type_ids = $types->random(rand(1, 4))->pluck('id')->toArray();

                // Attach Pivot
                $new_restaurant->types()->attach($type_ids);
            }
        }
    }
}
