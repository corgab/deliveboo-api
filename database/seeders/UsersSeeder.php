<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UsersSeeder extends Seeder
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
        $data = $this->getCSVData(__DIR__.'/csv/users.csv');

        foreach ( $data as $index=>$row) {
            if ($index !== 0) {

                $new_user = new User();

                $new_user->name = $row[0];
                $new_user->email = $row[1];
                $new_user->password = Hash::make($row[2]);

                // Salvataggio dati 
                $new_user->save();
            }
        }

    }
}
