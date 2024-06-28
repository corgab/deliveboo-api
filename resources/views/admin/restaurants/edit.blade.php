@extends('layouts.app')
@section('content')
    <section>
        <h1>EDIT</h1>

        <form action="{{ route('admin.restaurants.show', $restaurant) }}" method="GET">

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="slug" value="{{old('name', "$restaurant->name")}}">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug', "$restaurant->slug")}}">
            </div>

            <div class="mb-3">
                <label for="vat" class="form-label">P.IVA</label>
                <input type="text" class="form-control" id="vat" name="vat" value="{{old('vat', "$restaurant->vat")}}">
            </div>

            <!-- !! DA IMPLEMENTARE !! -->

            {{-- <div class="mb-3">
                <label for="thumb" class="form-label">Thumb</label>
                <input type="file" class="form-control" id="thumb" name="thumb">
            </div> --}}

            <button type="submit">invia</button>

        </form>


    </section>
@endsection
