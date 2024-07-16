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
        <h1 class="text-center mb-5 text-success">Il tuo menù</h1>
        <h2 class="h3 mb-4">
            Il tuo menù è vuoto. Registra il tuo primo piatto.</h2>

        <form action="{{ url('admin/dishes/create') }}" method="GET">
            <button type="submit" class="btn btn-outline-success btn-sm"><i class="bi bi-plus-square me-2"></i>{{ __('Registra il tuo piatto') }}
            </button>
        </form>
    </div>
    @else
    <div class="container">
        <div class="row">
            <h1 class="text-center text-success mb-5">Il tuo menù</h1>
            @foreach ($dishes as $dish)
            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
                <div class="card text-center p-4">
                    <h3 class="mb-3">{{ $dish->name }}</h3>
                    <figure>
                        @if($dish->thumb)
                        <img class="img-dish" src="{{ asset('storage/' . $dish->thumb) }}" alt="piatto {{ $dish->name }}">
                        @else
                        <img v-else class="img-dish" src="{{ asset('storage/images/logo.png') }}" alt="Foto Piatto">
                        @endif
                    </figure>
                    <div class="d-flex flex-column flex-sm-row gap-2 mt-3">
                        <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-outline-success btn-sm  mb-2 mb-sm-0">
                            <i class="bi bi-binoculars me-1"></i>
                            Visualizza
                        </a>
                        <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-outline-success btn-sm  mb-2 mb-sm-0">
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
                <div class="modal fade" id="exampleModal{{ $dish->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $dish->id }}" aria-hidden="true">
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
                                {{-- <form action="{{ route('admin.dishes.permanentDelete', $dish->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina definitivamente</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Link di paginazione -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    @if ($dishes->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $dishes->previousPageUrl() }}" aria-label="Previous">&laquo;</a>
                    </li>
                    @endif

                    @if ($dishes->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $dishes->nextPageUrl() }}" aria-label="Next">&raquo;</a>
                    </li>
                    @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                    @endif
                </ul>
            </nav>

        </div>
        {{-- end row --}}
        <a href="{{ route('admin.dishes.create', $dish) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-plus-square"></i>
            Aggiungi Piatto
        </a>
        {{-- <a href="{{route('admin.dishes.deletelist')}}">cestino</a> --}}
        @endif
</section>
@else
<div class="row">
    <h1>Per poter creare il tuo menù, registra il tuo ristorante!<h1>

            <a href="{{ url('admin/restaurants/create') }}" class="btn btn-sm btn-success">
                <i class="bi bi-plus-square"></i> {{ __('Registra il tuo Ristorante') }}</a>

</div>
@endif
@endsection