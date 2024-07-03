@extends('layouts.app')
@section('content')

<section>
    <div class="container">
        <h1 class="text-center py-5 text-white">Crea il tuo ristorante</h1>

        <form action="{{route('admin.restaurants.store')}}" method="POST">
            @csrf
            <!-- Restaurant_id value-->
            <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="mb-3">
            <label for="name" class="form-label">* <strong>Nome Ristorante</strong></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="types" class="form-label">* <strong>Tipologie</strong>:</label>
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
            <label for="address" class="form-label">* <strong>Indirizzo</strong></label>
            <input type="text" class="form-control" id="address" name="address" placeholder="es. Via roma 1" value="{{ old('address') }}">
        </div>
        <div class="mb-3">
            <label for="vat" class="form-label">* <strong>P.IVA</strong></label>
            <input type="text" class="form-control" id="vat" name="vat" value="{{ old('vat') }}">
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="thumb" name="thumb" value="{{ old('thumb') }}">
        </div>

            <button type="submit" class="btn btn-outline-light btn-sm mt-4">Registra la tua attività</button>
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
    <div class="text-center my-4">
        <h5 class="pb-5">I campi contrassegnati con * sono obbligatori.</h5>
    </div>

</section>
@endsection