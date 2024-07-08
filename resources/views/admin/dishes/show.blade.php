@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <h1 class="text-center mb-5 text-primary">Dettaglio Piatto</h1>
        @if($dish->thumb)
        <ul class="lh-lg">
            <li>
                <img class="img-dish mb-2 mt-5" src="{{ asset('storage/' . $dish->thumb) }}" alt="Foto Piatto">
            </li>
        @endif
            <li class="fs-show"><strong>Nome piatto</strong>: {{ $dish->name }}</li>
            <li class="fs-show"><strong>Descrizione ingredienti</strong>: {{ $dish->description_ingredients }}</li>
            <li class="fs-show"><strong>Prezzo</strong>: {{ $dish->price }} €</li>
        </ul>
    </div>


    <div class="container">
        <!-- Check Boolean -->
        @if ($dish->visible == true)
            <h3 class="h5">Visibile</h3>
        @else
            <h3 class="h5">Non visibile</h3>
        @endif
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminazione Piatto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Sicuro di voler eliminare il piatto ("{{ $dish->name }}")?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{route('admin.dishes.destroy', $dish)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-secondary">Elimina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Eliminazione piatto
    </button>
    <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-outline-primary btn-sm">
        Modifica
    </a>




</section>
@endsection