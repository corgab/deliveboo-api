@extends('layouts.app')
@section('content')

<section>
    <h1>index</h1>
    @foreach ($restaurants as $restaurant)
        <h1>{{ $restaurant->name}}</h1>
    @endforeach

</section>

@endsection