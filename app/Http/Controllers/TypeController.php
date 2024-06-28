<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }

    public function show($id)
    {
        $type = Type::findOrFail($id);
        return view('types.show', compact('type'));
    }
}
