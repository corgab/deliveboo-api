@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <h1 class="text-center mb-5 text-success">Dettaglio Piatto</h1>
        @if($dish->thumb)
        <ul class="lh-lg">
            <li>
                <img class="img-dish mb-3 mt-5" src="{{ asset('storage/' . $dish->thumb) }}" alt="Foto Piatto">
            </li>
            @else
            <ul class="lh-lg">
                <img v-else class="img-dish mb-3 mt-5" src="{{ asset('storage/images/logo.png') }}" alt="Foto Piatto">
        @endif
            <li class="fs-show mb-3"><strong>Nome piatto</strong>: {{ $dish->name }}</li>
            <li class="fs-show mb-3"><strong>Descrizione ingredienti</strong>: {{ $dish->description_ingredients }}</li>
            <li class="fs-show mb-3"><strong>Prezzo</strong>: {{ $dish->price }} €</li>
            <li>
                @if ($dish->visible == true)
                <h3 class="h5 text-success">Visibile</h3>
                @else
                <h3 class="h5 text-danger">Non visibile</h3>
                @endif
            </li>
        </ul>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{route('admin.dishes.destroy', $dish)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                    {{-- <form action="{{ route('admin.dishes.permanentDelete', $dish->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina definitivamente</button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Da togliere --}}
    <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-start align-items-center gap-3 mt-4">
        <button type="button" class="btn btn-sm btn-outline-danger mb-2 mb-md-0 me-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-trash-fill"></i>
            Eliminazione piatto
        </button>
        <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-pen-fill"></i>
            Modifica
        </a>
    </div>
</section>
@endsection