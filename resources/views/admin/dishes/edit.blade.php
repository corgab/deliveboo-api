@extends('layouts.app')

@section('content')
<form action="{{ route('admin.dishes.update', $dish) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

    <h1 class="mb-5 text-success text-center">Modifica piatto</h1>
    <div class="mb-4">
        <label for="name" class="form-label fw-bold">Nome *</label>
        <input type="text" required name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $dish->name) }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description_ingredients" class="form-label fw-bold">Descrizione / Ingredienti *</label>
        <input type="text" required maxlength="100" name="description_ingredients" class="form-control @error('description_ingredients') is-invalid @enderror" id="description_ingredients" value="{{ old('description_ingredients', $dish->description_ingredients) }}">
        @error('description_ingredients')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="price" class="form-label fw-bold">Prezzo € *</label>
        <input type="text" required min="1" max="900" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price', $dish->price) }}">
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @if($dish->thumb)
    <div class="py-2">
        <img src="{{ asset('storage/' . $dish->thumb) }}" alt="foto piatto" style="width:200px">
    </div>
    <button name="remove_image" value="1" class="btn btn-outline-danger btn-sm my-2">Rimuovi immagine</button>
    @endif
    <div class="input-group mb-3">
        <label for="thumb">Inserisci immagine:</label>
        <input type="file" class="form-control" id="thumb" name="thumb">
    </div>
    
    <div class="mb-4">
        <div class="form-check form-switch">
            <input type="hidden" name="visible" value="0">
            <input class="form-check-input" type="checkbox" role="switch" id="visible" name="visible" value="1" {{old('visible', $dish->visible) == 1 ? 'checked' : ''}}>
            <label class="form-check-label" for="visible">Mostra</label>
        </div>
    </div>
   
    <div class="d-flex justify-content-evenly mt-5">
        <button type="submit" class="btn btn-outline-success"><i class="bi bi-pen-fill"></i>Salva Modifica</button>
        <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-outline-success"><i class="bi bi-arrow-left"></i> Indietro</a>
    </div>
</form>
<div class="text-center my-4">
    <h5>I campi contrassegnati con * sono obbligatori.</h5>
</div>

@endsection

@section('script')
<script>
// Prendere elemento dal dom
document.getElementById('price').addEventListener('keydown', function(event) {
    const validChars = [
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
        'Backspace', 'ArrowLeft', 'ArrowRight', '.'
    ];

    // Bloccare la scrittura delle lettere
    if (!validChars.includes(event.key)) { // Se il tasto premuto non è nell'array
        event.preventDefault(); // Blocca l'inserimento del tasto
    }
});
</script>
@endsection