@extends('layouts.app')
@section('content')
    <section>
        <h1>EDIT</h1>

        <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name', $restaurant->name)}}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address" name="address" value="{{old('address', $restaurant->address)}}">
            </div>

            <div class="mb-3">
                <label for="vat" class="form-label">P.IVA</label>
                <input type="text" class="form-control" id="vat" name="vat" value="{{old('vat', $restaurant->vat)}}">
            </div>

            <!-- !! DA IMPLEMENTARE !! -->

            {{-- <div class="mb-3">
                <label for="thumb" class="form-label">Thumb</label>
                <input type="file" class="form-control" id="thumb" name="thumb">
            </div> --}}

            <button type="submit">invia</button>

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


    </section>
@endsection
