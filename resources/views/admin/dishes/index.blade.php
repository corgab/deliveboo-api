@extends('layouts.app')
@section('content')

<section>
    <h1>INDEX</h1>
    @foreach ($dishes as $dish)
    <div class="d-flex">
        <h3>{{ $dish->name}}</h3>


    </div>

    @endforeach

</section>

@endsection