@extends('layouts.app')

@section('content')
<section class="mt-3">
@if(isset($error))
<div class="alert alert-danger text-center" style="font-size: 1rem;">
    <h4>{{ $error }}</h4>
</div>
@endif
@if(isset($dishes))
    @if($dishes->isEmpty())
        <div class="row">
            <h1 class="text-center mb-5 text-primary">Il tuo menù</h1>
            <h2 class="h3 mb-4">
                Il tuo menù è vuoto. Registra il tuo primo piatto.</h2>

            <form action="{{ url('admin/dishes/create') }}" method="GET">
                <button type="submit" class="btn btn-success btn-sm">
                    {{ __('Registra il tuo piatto') }}
                </button>
            </form>
        </div>
    @else
    <div class="container">
        <div class="row">
            <h1 class="text-center text-primary mb-5">I tuoi piatti</h1>
            @foreach ($dishes as $dish)
            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
                <div class="card text-center p-4">
                    <h3 class="mb-3">{{ $dish->name }}</h3>
                    <figure>
                        @if($dish->thumb)
                            <img class="img-dish" src="{{ asset('storage/' . $dish->thumb) }}" alt="{{ $dish->name }}">
                        @endif
                    </figure>
                    <div class="d-flex flex-column flex-sm-row gap-2 mt-3"> 
                        <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-outline-primary btn-sm  mb-2 mb-sm-0">
                            <i class="bi bi-binoculars me-1"></i>
                            Visualizza
                        </a>
                        <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-outline-primary btn-sm  mb-2 mb-sm-0">
                            <i class="bi bi-pen-fill"></i>
                            Modifica
                        </a>
                        <button type="button" class="btn btn-outline-danger btn-sm  mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $dish->id }}">
                            <i class="bi bi-trash"></i>
                            Elimina
                        </button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $dish->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel{{ $dish->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel{{ $dish->id }}">Eliminazione Piatto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Optional: Add any additional information here -->
                                Sicuro di voler eliminare il piatto ("{{ $dish->name }}")?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div> 
        {{-- end row --}}
        <a href="{{ route('admin.dishes.create', $dish) }}" class="btn btn-outline-primary btn-sm">
            Aggiungi Piatto
        </a>
    @endif
</section>
@else
<div class="row">
    <h1>
        Per poter creare il tuo menù, registra il tuo ristorante! <br>
        <a class="dropdown-item btn"
            href="{{ url('admin/restaurants/create') }}">{{__('Registra il tuo Ristorante')}}</a>
    </h1>
</div>
@endif
@endsection