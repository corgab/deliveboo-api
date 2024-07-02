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
                <label for="name" class="form-label text-white"><strong>Nome del ristorante</strong></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label text-white"><strong>Indirizzo</strong></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Via Dante, 68, Roma"
                    value="{{ old('address') }}">
            </div>
            <div class="mb-3">
                <label for="vat" class="form-label text-white"><strong>P. IVA</strong></label>
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

</section>
@endsection