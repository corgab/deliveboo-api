@extends('layouts.app')
@section('content')
    <section>
        <h1>Modifica dati</h1>

        <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label"><strong>* Nome</strong></label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name', $restaurant->name)}}">
            </div>

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="mb-3">
                <label for="address" class="form-label"><strong>* Indirizzo</strong></label>
                <input type="text" class="form-control" id="address" name="address" value="{{old('address', $restaurant->address)}}">
            </div>

            <div class="mb-3">
                <label for="types" class="form-label"><strong>* Tipologie</strong>:</label>
                <div class="form-check d-flex flex-wrap">
                    @foreach ($types as $type)
                        <div class="col-2">

                            <input @checked(in_array($type->id, old('type_id', $restaurant->types->pluck('id')->all()))) name="type_id[]" type="checkbox" value="{{$type->id}}" id="type-{{$type->id}}">
                            <label for="type-{{ $type->id }}">{{ $type->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label for="vat" class="form-label"><strong>* P.IVA</strong></label>
                <input type="text" class="form-control" id="vat" name="vat" value="{{old('vat', $restaurant->vat)}}">
            </div>

            <!-- !! DA IMPLEMENTARE !! -->

            {{-- <div class="mb-3">
                <label for="thumb" class="form-label">Thumb</label>
                <input type="file" class="form-control" id="thumb" name="thumb">
            </div> --}}

            <button type="submit">Invia</button>
            
        </form>
        <div class="text-center my-4">
            <h5 class="pb-5">I campi contrassegnati con * sono obbligatori.</h5>
        </div>

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
