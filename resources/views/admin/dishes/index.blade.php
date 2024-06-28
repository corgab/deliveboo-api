@extends('layouts.app')
@section('content')

<section>
    <h1>INDEX</h1>
    @foreach ($dishes as $dish)
    <div class="d-flex">
        <h3>{{ $dish->name}}</h3>

        <a href="{{route('admin.dishes.show', $dish)}}" class="btn btn-primary">show</a>


    </div>
    @endforeach

</section>

@endsection