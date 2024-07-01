@extends('layouts.app')
@section('content')

<section>

    <h1>Create</h1>

    <form action="{{route('admin.restaurants.store')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome Ristorante</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="es. Via roma 1" value="{{ old('address') }}">
        </div>
        <div class="mb-3">
            <label for="vat" class="form-label">P.IVA</label>
            <input type="text" class="form-control" id="vat" name="vat" value="{{ old('vat') }}">
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="thumb" name="thumb" value="{{ old('thumb') }}">
        </div>

        <button type="submit" class="btn btn-primary">Registra la tua Attività</button>


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