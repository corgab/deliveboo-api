@extends('layouts.app')
@section('content')

<section>
    <div class="container">
        <h1 class="mb-5 text-center" style="font-size: 1.5rem;">Dettaglio ristorante <br> <span
                class="text-danger">Deliveboo</span></h1>
        <ul class="lh-lg mb-4" style="font-size: 1rem;">
            <li><strong>Nome attività</strong>: "{{ $restaurant->name }}"</li>
            <li><strong>Slug</strong>: {{ $restaurant->slug }}</li>
            <li><strong>Indirizzo</strong>: {{ $restaurant->address }}</li>
            <li><strong>P. IVA</strong>: {{ $restaurant->vat }}</li>
            <li><strong>Foto</strong>: {{ $restaurant->thumb }}</li>
        </ul>


        <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-outline-light btn-sm"><i class="bi bi-trash me-1"></i>Elimina</button>
        </form>
    </div>
</section>

@endsection