@extends('layouts.app')
@section('content')

<section>
    <div class="container">
        <h1 class="text-center py-5 text-white">Crea il tuo ristorante</h1>

        <form action="{{route('admin.restaurants.store')}}" method="POST">
            @csrf
            <!-- user_id value-->
            <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="mb-3">
            <label for="name" class="form-label">* Nome Ristorante</label>
            <input type="text" required class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') ? 'is-valid' : '') }}" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="types" class="form-label">* Tipologie:</label>
            <div class="form-check d-flex flex-wrap">
                @foreach ($types as $type)
                    <div class="col-2">
                        <input @checked(in_array($type->id, old('type_id', []))) name="type_id[]" type="checkbox" value="{{ $type->id }}"
                            id="type-{{ $type->id }}">
                        <label for="type-{{ $type->id }}">{{ $type->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">* Indirizzo</label>
            <input type="text" required class="form-control {{ $errors->has('address') ? 'is-invalid' : (old('address') ? 'is-valid' : '') }}" id="address" name="address" placeholder="es. Via roma 1" value="{{ old('address') }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="vat" class="form-label">* P.IVA</label>
            <input type="text" required class="form-control {{ $errors->has('vat') ? 'is-invalid' : (old('vat') ? 'is-valid' : '') }}" id="vat" name="vat" value="{{ old('vat') }}">
            @error('vat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="thumb" name="thumb" value="{{ old('thumb') }}">
        </div>

        <button type="submit" class="btn btn-outline-light btn-sm mt-4">Registra la tua attività</button>
    </div>
    </form>
        
    </div>
    <div class="text-center my-4">
        <h5>I campi contrassegnati con * sono obbligatori.</h5>
    </div>

</section>
@section('sections')
<!-- !! JAVASCRIPT !! -->
@endsection
@endsection