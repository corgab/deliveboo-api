@extends('layouts.app')
@section('content')
    <section>
        <h1>SHOW</h1>
        <h3>{{ $dish->id }}</h3>
        <h3>{{ $dish->name }}</h3>
        <h3>{{ $dish->description_ingredients }}</h3>
        <h3>{{ $dish->price }}</h3>
        
        <!-- Check Boolean -->
        @if ($dish->visible === 1)
            <h3>Visibile</h3>
        @else
           <h3>Non visibile</h3> 
        @endif

        <h3>{{ $dish->created_at}}</h3>
        <h3>{{ $dish->updated_at}}</h3>

    </section>
@endsection
