<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;

use Illuminate\Support\Facades\DB;


class restaurant_typeSeeder extends Seeder
{


    public function run(): void
    {


        $restaurants_types = [

["restaurant_id" => 1,"type_id" => 1],
["restaurant_id" => 1,"type_id" => 2],
["restaurant_id" => 2,"type_id" => 3],
["restaurant_id" => 2,"type_id" => 10],
["restaurant_id" => 3,"type_id" => 1],
["restaurant_id" => 4,"type_id" => 5],
["restaurant_id" => 5,"type_id" => 1],
["restaurant_id" => 5,"type_id" => 4],
["restaurant_id" => 6,"type_id" => 1],
["restaurant_id" => 6,"type_id" => 2],
["restaurant_id" => 7,"type_id" => 9],
["restaurant_id" => 8,"type_id" => 7],
["restaurant_id" => 9,"type_id" => 1],
["restaurant_id" => 9,"type_id" => 8],
["restaurant_id" => 10,"type_id" => 1],
["restaurant_id" => 10,"type_id" => 2],
["restaurant_id" => 11,"type_id" => 1],
["restaurant_id" => 12,"type_id" => 1],
["restaurant_id" => 12,"type_id" => 6],
["restaurant_id" => 13,"type_id" => 1],
["restaurant_id" => 13,"type_id" => 10],
["restaurant_id" => 14,"type_id" => 10],
["restaurant_id" => 14,"type_id" => 6],
["restaurant_id" => 15,"type_id" => 5],
["restaurant_id" => 15,"type_id" => 4],
["restaurant_id" => 16,"type_id" => 1],
["restaurant_id" => 16,"type_id" => 4],
["restaurant_id" => 17,"type_id" => 1],
["restaurant_id" => 17,"type_id" => 7],
["restaurant_id" => 18,"type_id" => 1],
["restaurant_id" => 18,"type_id" => 2],
["restaurant_id" => 18,"type_id" => 9],
["restaurant_id" => 19,"type_id" => 2],
["restaurant_id" => 19,"type_id" => 3],
["restaurant_id" => 19,"type_id" => 10],
["restaurant_id" => 20,"type_id" => 2],
["restaurant_id" => 20,"type_id" => 9],
["restaurant_id" => 21,"type_id" => 1],
["restaurant_id" => 21,"type_id" => 4],
["restaurant_id" => 22,"type_id" => 1],
["restaurant_id" => 22,"type_id" => 8],
["restaurant_id" => 23,"type_id" => 6],
["restaurant_id" => 24,"type_id" => 1],
["restaurant_id" => 24,"type_id" => 2],
["restaurant_id" => 25,"type_id" => 1],
["restaurant_id" => 25,"type_id" => 9],
["restaurant_id" => 26,"type_id" => 2],
["restaurant_id" => 27,"type_id" => 1],
["restaurant_id" => 27,"type_id" => 6],
["restaurant_id" => 28,"type_id" => 3],
["restaurant_id" => 29,"type_id" => 1],
["restaurant_id" => 29,"type_id" => 2],
["restaurant_id" => 29,"type_id" => 4],
["restaurant_id" => 30,"type_id" => 5],

        ];


        foreach ($restaurants_types as $restaurant_type) {
            DB::table('restaurant_type')->insert($restaurant_type);
        }
    }
}

