@extends('layouts.app')

@section('content')
<form action="{{route('admin.dishes.update', $dish)}}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
    
    <div class="mb-4">
        <label for="name" class="form-label fw-bold">Nome</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name', $dish->name)}}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description_ingredients" class="form-label fw-bold">Descrizione / Ingredienti</label>
        <input type="text" name="description_ingredients" class="form-control @error('description_ingredients') is-invalid @enderror" id="description_ingredients" value="{{old('description_ingredients', $dish->description_ingredients)}}">
        @error('description_ingredients')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="price" class="form-label fw-bold">Prezzo €</label>
        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{old('price', $dish->price)}}">
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="thumb" name="thumb" value="{{ old('thumb',  $dish->thumb)}}">
    </div>
    <div class="d-flex gap-3">
        <div class="form-check">
            <label class="form-check-label" for="visible">
                Visibile
            </label>
        </div>
        <select name="visible" id="visible">
            <option value="0">No</option>
            <option value="1">Si</option>
        </select>
    </div>
   
    <div class="d-flex justify-content-evenly pt-3">
        <button type="submit" class="btn btn-primary fw-bold">Edit</button>
        <a href="{{route('admin.dishes.show', $dish)}}" class="btn btn-warning text-primary fw-bold">Back</a>
    </div>
</form>


<div class="my-4 centered w-25">
    @if ( $errors->any() )
    <div class="alert alert-danger op-90">
        <ul>
            @foreach($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection