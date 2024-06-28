<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\Dish;

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

    public function run(): void
    {
        // Data file orders.csv
        $data = $this->getCSVData(__DIR__.'/csv/orders.csv');

        // Recupero Piatti
        $dishes = Dish::all();

         foreach ($data as $index=>$row) {
            if ($index !== 0) {
                $new_order = new Order();

                $new_order->name = $row[0];
                $new_order->email = $row[1];
                $new_order->number = $row[2];
                $new_order->address = $row[3];
                $new_order->total_price = $row[4];
                
                // Salvataggio dati 
                $new_order->save();

                // Id randomico di Type in un array
                $dishIds = $dishes->random(rand(1, 10))->pluck('id')->toArray();

                // Attach Pivot
                $new_order->dishes()->attach($dishIds);
            }
        }
    }
}