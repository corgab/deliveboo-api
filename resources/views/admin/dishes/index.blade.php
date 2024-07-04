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
            <h1>
                IL TUO MENU E' VUOTO! REGISTRA IL TUO PRIMO PIATTO! <br>
                <a class="dropdown-item btn" href="{{ url('admin/dishes/create') }}">{{__('Registra il tuo Piatto')}}</a>
            </h1>
        </div>
    @else
    <div class="container">
        <div class="row">
            @foreach ($dishes as $dish)
            <div class="col-4 d-flex justify-content-center">
                <div class="card text-center p-4 mb-4">
                    <h3>{{ $dish->name }}</h3>
                    <figure>
                        <img class="img-dish" src="{{ Vite::asset("resources/img/dishes/$dish->thumb")}}" alt="Foto Piatto">
                    </figure>
                    <div class="d-flex gap-4"> 
                        <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-binoculars me-1"></i>
                            Visualizza
                        </a>
                        <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-pen-fill"></i>
                            Modifica
                        </a>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $dish->id }}">
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
                                    <button type="submit" class="btn btn-danger">Elimina definitivamente</button>
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
        PER POTER CREARE IL TUO MENU', REGISTRA IL TUO RISTORANTE! <br>
        <a class="dropdown-item btn" href="{{ url('admin/restaurants/create') }}">{{__('Registra il tuo Ristorante')}}</a>
    </h1>
</div>
@endif
@endsection
