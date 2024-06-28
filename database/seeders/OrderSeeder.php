<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            }
        }
    }
}