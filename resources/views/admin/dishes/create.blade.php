@extends('layouts.app')

@section('content')
<form action="{{route('admin.dishes.store')}}" method="POST">
    @csrf

    <!-- Restaurant_id value-->
    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
    <div class="container">

        <div class="mb-4">
            <label for="name" class="form-label fw-bold mt-5">Nome piatto</label>
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') ? 'is-valid' : '') }}" id="name" placeholder="Scrivi il nome del piatto" value="{{old('name')}}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description_ingredients" class="form-label fw-bold">Descrizione ingredienti</label>
            <input type="text" name="description_ingredients" class="form-control {{ $errors->has('description_ingredients') ? 'is-invalid' : (old('description_ingredients') ? 'is-valid' : '') }}" id="description_ingredients"
                placeholder="Inserisci gli incredienti usati" value="{{old('description_ingredients')}}">
            @error('description_ingredients')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror    
        
        </div>
        <div class="mb-4">
            <label for="price" class="form-label fw-bold">Prezzo €</label>
            <input type="text" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : (old('price') ? 'is-valid' : '') }}" id="description_ingredients" id="price" placeholder="0.00" value="{{old('price')}}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror 
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="thumb" name="thumb" value="{{ old('thumb') }}">
        </div>

        <div class="d-flex justify-content-center gap-5 align-items-center">
            <div class="d-flex gap-3">
                <div class="form-check">
                    <label class="form-check-label" for="visible">
                        Visibile
                    </label>
                </div>
                <select name="visible" id="visible">
                    <option value="0">No</option>
                    <option value="1" selected>Si</option>
                </select>
            </div>

            <a href="{{route('admin.dishes.index')}}" class="btn btn-light fw-bold">Indietro</a>
            <button type="submit" class="btn btn-success fw-bold">Crea piatto</button>
        </div>
    </div>
</form>

@endsection