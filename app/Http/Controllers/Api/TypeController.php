<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index(){
        $types = Type::with('restaurants')->get(); //paginate
        return response()->json([
            'types' => $types
            // 'success' => true 
            // da valutare se usarlo o meno
         ]); 
    }

    public function show(Type $type){

        $type ->load( 'restaurants' );

        return response()->json([
            'type' => $type
        ]);
    }
}
