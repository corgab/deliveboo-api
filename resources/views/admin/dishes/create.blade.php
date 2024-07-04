@extends('layouts.app')

@section('content')
<form action="{{route('admin.dishes.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($restaurant !== null)
            <!-- Restaurant_id value-->
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

            {{-- @dd($restaurant) --}}
            <div class="container">

                <div class="my-4">
                    <label for="name" class="form-label fw-bold mt-5">Nome piatto</label>
                    <input type="text" name="name" required
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') ? 'is-valid' : '') }}"
                        id="name" placeholder="Scrivi il nome del piatto" value="{{old('name')}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-4">
                    <label for="description_ingredients" class="form-label fw-bold">Descrizione ingredienti</label>
                    <input type="text" required name="description_ingredients"
                        class="form-control {{ $errors->has('description_ingredients') ? 'is-invalid' : (old('description_ingredients') ? 'is-valid' : '') }}"
                        id="description_ingredients" placeholder="Inserisci gli incredienti usati"
                        value="{{old('description_ingredients')}}">
                    @error('description_ingredients')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="my-4">
                    <label for="price" class="form-label fw-bold">Prezzo €</label>
                    <input type="text" required name="price"
                        class="form-control {{ $errors->has('price') ? 'is-invalid' : (old('price') ? 'is-valid' : '') }}"
                        id="description_ingredients" id="price" placeholder="0.00" value="{{old('price')}}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <div>
                        <label for="thumb">Immagine:</label>
                        <input type="file" name="thumb" id="thumb">
                    {{-- <input type="file" class="my-4 form-control" id="thumb" name="thumb"> --}}
                    @error('thumb')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-center gap-4 align-items-center py-5">
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

                    <a href="{{route('admin.dishes.index')}}" class="btn btn-sm btn-danger">Indietro</a>
                    <button type="submit" class="btn btn-sm btn-success ">Crea piatto</button>
                </div>
            </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    @else
            <h1>Per poter aggiungere i tuoi piatti, registra il tuo ristorante.</h1>

            <form action="{{ url('admin/restaurants/create') }}" method="GET">
                <button type="submit" class="btn btn-success btn-sm mt-4">
                    {{ __('Registra il tuo ristorante') }}
                </button>
            </form>

        </div>
    @endif

@endsection