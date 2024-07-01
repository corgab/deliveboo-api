<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Type;

class TypeSeeder extends Seeder
{
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
        $data = $this->getCSVData(__DIR__.'/csv/types.csv');

        foreach ( $data as $index=>$row) {
            if ($index !== 0) {

                $new_type = new Type();

                $new_type->name = $row[0];
                $new_type->slug = Str::slug($new_type->name, '-');

                // Salvataggio dati 
                $new_type->save();


            }
        }
    }
}
