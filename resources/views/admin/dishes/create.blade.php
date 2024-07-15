@extends('layouts.app')

@section('content')
<form action="{{route('admin.dishes.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($restaurant !== null)
            <!-- Restaurant_id value-->
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

            <div class="container">
                <h1 class="text-center mb-5 text-success">Crea il tuo piatto</h1>

                <div class="my-4">
                    <label for="name" class="form-label fw-bold mt-5">Nome piatto *</label>
                    <input type="text" required maxlength="100" name="name" required
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') ? 'is-valid' : '') }}"
                        id="name" placeholder="Scrivi il nome del piatto" value="{{old('name')}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-4">
                    <label for="description_ingredients" class="form-label fw-bold">Descrizione ingredienti *</label>
                    <input type="text" required name="description_ingredients"
                        class="form-control {{ $errors->has('description_ingredients') ? 'is-invalid' : (old('description_ingredients') ? 'is-valid' : '') }}"
                        id="description_ingredients" placeholder="Inserisci gli incredienti usati"
                        value="{{old('description_ingredients')}}">
                    @error('description_ingredients')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="my-4">
                    <label for="price" class="form-label fw-bold">Prezzo € *</label>
                    <input type="text" required min="1" max="900" name="price"
                        class="form-control {{ $errors->has('price') ? 'is-invalid' : (old('price') ? 'is-valid' : '') }}"
                        id="price" placeholder="0.00" value="{{old('price')}}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-4">
                    <label for="thumb" class="form-label"><strong>Immagine</strong></label>
                    <input type="file" class="form-control" name="thumb" id="thumb">
                    @error('thumb')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-4">
                    <div class="form-check form-switch">
                        <input type="hidden" name="visible" value="0">
                        <input class="form-check-input" type="checkbox" role="switch" id="visible" name="visible" value="1" checked>
                        <label class="form-check-label" for="visible">Mostra</label>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-4 align-items-center py-5">
                    <a href="{{route('admin.dishes.index')}}" class="btn btn-sm btn-outline-success"><i class="bi bi-arrow-left"></i>
                    Indietro</a>
                    <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-plus-square"></i>
                    Crea</button>
                </div>
            </div>
        </form>

        <div class="text-center mt-2">
            <h5 class="pb-5">I campi contrassegnati con * sono obbligatori.</h5>
        </div>
    @else
    <div class="row">
        <h1>Per poter creare il tuo piatto, registra il tuo ristorante!<h1>
    
        <a href="{{ url('admin/restaurants/create') }}" class="btn btn-sm btn-success">
        <i class="bi bi-plus-square"></i> {{ __('Registra il tuo Ristorante') }}</a>
    
    </div>
    @endif

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
})
</script>
@endsection

@endsection