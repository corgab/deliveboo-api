@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <section>
        <h1 class="text-center mb-5" style="font-size: 1.5rem;">Lista ristoranti <br> <span class="text-danger">Deliveboo</span></h1>
        @foreach ($restaurants as $restaurant)
        <div class="d-flex align-items-center gap-3 mb-4">
            <p class="h4 m-0" style="font-size: 1.20rem;">"{{ $restaurant->name }}"</p>
            <a href="{{ route('admin.restaurants.show', $restaurant) }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-binoculars me-1"></i> Mostra
            </a>
            <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf
                <button class="btn btn-outline-danger" style="font-size: 0.875rem;">
                    <i class="bi bi-trash me-1 btn-sm"></i> Elimina
                </button>
            </form>
        </div>
        @endforeach

        @if(isset($error))
        <div class="alert alert-danger text-center" style="font-size: 1rem;">
            <h4>{{ $error }}</h4>
        </div>
        @endif
    </section>
</div>
@endsection
