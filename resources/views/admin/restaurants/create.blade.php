@extends('layouts.app')
@section('content')

<section>
    <div class="container">
        <h1 class="text-center py-5 text-success">Crea il tuo ristorante</h1>

        <form id="restaurant-form" action="{{route('admin.restaurants.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- user_id value-->
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="mb-3">
                <label for="name" class="form-label"><strong>Nome Ristorante * </strong></label>
                <input type="text" required maxlength="150" class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') ? 'is-valid' : '') }}" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="types" class="form-label"><strong>Tipologie * </strong>:</label>
                @error('type_id')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
                <div class="form-check d-flex flex-wrap">
                    @foreach ($types as $type)
                        <div class="col-2">
                            <input @checked(in_array($type->id, old('type_id', []))) class="form-check-input @error('type_id') is-invalid @enderror" name="type_id[]" type="checkbox" value="{{ $type->id }}" id="type-{{ $type->id }}">
                            <label class="form-check-label" for="type-{{ $type->id }}">{{ $type->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div id="type-error" class="text-danger" style="display: none;">Seleziona almeno una tipologia.</div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label"><strong>Indirizzo * </strong></label>
                <input type="text" required maxlength="255" class="form-control {{ $errors->has('address') ? 'is-invalid' : (old('address') ? 'is-valid' : '') }}" id="address" name="address" placeholder="es. Via roma 1" value="{{ old('address') }}">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="vat" class="form-label"><strong>P.IVA *</strong></label>
                <input type="text" required minlength="11" maxlength="11" class="form-control {{ $errors->has('vat') ? 'is-invalid' : (old('vat') ? 'is-valid' : '') }}" id="vat" name="vat" value="{{ old('vat') }}">
                @error('vat')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group mb-3">
                <label for="thumb" class="form-label"><strong>Immagine</strong></label>
                <input type="file" class="form-control mx-3" id="thumb" name="thumb">
                @error('thumb')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" id="submit-btn" class="btn btn-success btn-sm mt-4">Registra la tua attività</button>
        </form>
        
    </div>
    <div class="text-center my-4">
        <h5 class="pb-5">I campi contrassegnati con * sono obbligatori.</h5>
    </div>

</section>
@section('script')
<script>
// Prendere elemento dal dom
document.getElementById('vat').addEventListener('keydown', function(event) {
    const validChars = [
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
        'Backspace', 'ArrowLeft', 'ArrowRight', '.'
    ];

    // Bloccare la scrittura delle lettere
    if (!validChars.includes(event.key)) { // Se il tasto premuto non è nell'array
        event.preventDefault(); // Blocca l'inserimento del tasto
    }
});

// Verifica lato client per le tipologie
document.getElementById('restaurant-form').addEventListener('submit', function(event) {
    const checkboxes = document.querySelectorAll('input[name="type_id[]"]');
    let checked = false;
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            checked = true;
        }
    });

    const typeError = document.getElementById('type-error');
    if (!checked) {
        event.preventDefault();
        typeError.style.display = 'block';
    } else {
        typeError.style.display = 'none';
    }
});
</script>
@endsection
@endsection