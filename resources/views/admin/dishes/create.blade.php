@extends('layouts.app')

@section('content')
<form action="{{route('admin.dishes.store')}}" method="POST">
    @csrf

    <!-- Restaurant_id value-->
    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
    <div class="container">

        <div class="mb-4">
            <label for="name_project" class="form-label fw-bold mt-5">Nome piatto</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Scrivi il nome del piatto"
                value="{{old('name')}}">
        </div>
        <div class="mb-4">
            <label for="description_ingredients" class="form-label fw-bold">Descrizione ingredienti</label>
            <input type="text" name="description_ingredients" class="form-control" id="description_ingredients"
                placeholder="Inserisci gli incredienti usati" value="{{old('description_ingredients')}}">
        </div>
        <div class="mb-4">
            <label for="price" class="form-label fw-bold">Prezzo</label>
            <textarea type="text" name="price" class="form-control" id="price" placeholder="Costo del piatto" rows="8"
                value="{{old('price')}}">
        </textarea>
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="thumb" name="thumb" value="{{ old('thumb') }}">
        </div>

        <div class="d-flex justify-content-center gap-5 align-items-center">
            <div class="d-flex gap-3">
                <div class="form-check">
                    <label class="form-check-label" for="visible">
                        Visible:
                    </label>
                </div>
                <select name="visible" id="visible">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>

            <a href="{{route('admin.dishes.index')}}" class="btn btn-light fw-bold">Indietro</a>
            <button type="submit" class="btn btn-success fw-bold">Crea piatto</button>
        </div>
    </div>
</form>


<div class="my-4 centered w-25">
    @if ($errors->any())
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