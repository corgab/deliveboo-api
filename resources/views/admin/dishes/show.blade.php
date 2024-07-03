@extends('layouts.app')
@section('content')
<section>
    <h1 class="text-center" style="font-size: 1.5rem;">Dettaglio Piatto <br> 
    <span class="text-danger">Deliveboo</span></h1>
    <ul class="lh-lg">
        <li><strong>Nome</strong>: {{ $dish->name }}</li>
        <li><strong>Descrizione ingredienti</strong>: {{ $dish->description_ingredients }}</li>
        <li><strong>Prezzo</strong>: {{ $dish->price }} €</li>
    </ul>


    <!-- Check Boolean -->
    @if ($dish->visible == true)
        <h3>Visibile</h3>
    @else
        <h3>Non visibile</h3>
    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminazione Piatto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-danger text-center text-white">
                    Sicuro di voler eliminare il piatto ("{{ $dish->name }}")?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{route('admin.dishes.destroy', $dish)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Elimina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Eliminazione piatto
    </button>
    <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-outline-primary btn-sm">
        Modifica
    </a>
</section>
@endsection