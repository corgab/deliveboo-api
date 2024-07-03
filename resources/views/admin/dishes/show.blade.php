@extends('layouts.app')
@section('content')
<section>
    <div class="container mt-3">
        <h1 class="text-center pt-4 lh-base">Dettaglio Piatto <br>
            <span class="text-danger">Deliveboo</span>
        </h1>
        <ul class="lh-lg">
            <li class="fs-5"><strong>Nome piatto</strong>: {{ $dish->name }}</li>
            <li class="fs-5"><strong>Descrizione ingredienti</strong>: {{ $dish->description_ingredients }}</li>
            <li class="fs-5"><strong>Prezzo</strong>: {{ $dish->price }} €</li>
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
                        <button type="submit" class="btn btn-sm btn-danger">Elimina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center"> <button type="button" class="btn btn-danger my-5" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Eliminazione piatto
        </button></div>

</section>
@endsection