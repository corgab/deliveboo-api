@extends('layouts.app')

@section('content')
<h1>Cestino</h1>
@foreach ($dishes as $dish)
    <p>{{ $dish->name }}</p>
    <!-- Aggiungi il link per ripristinare il piatto -->
    <form action="{{ route('dishes.restore', $dish) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit">Ripristina</button>
    </form>
@endforeach
@endsection