@extends('layouts.app')
@section('content')

<section>
    <h1>INDEX</h1>
    @foreach ($restaurants as $restaurant)
    <div class="d-flex">
        <h3>{{ $restaurant->name}}</h3>

        <a href="{{route('admin.restaurants.show', $restaurant)}}" class="btn btn-primary">show</a>

        <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">elimina</button>
        </form>
    </div>

    @endforeach

</section>

@endsection