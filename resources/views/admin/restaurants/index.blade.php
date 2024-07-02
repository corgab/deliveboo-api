@extends('layouts.app')

@section('content')

<section>

    <h1>INDEX</h1>
    {{-- @foreach ($restaurants as $restaurant) --}}

    
        @if (is_null($restaurant) === null)
            <h1>Crea il tuo primo ristorante</h1>
        @else
            <div class="d-flex">
                <h3>{{ $restaurant->name}}</h3>

                <a href="{{route('admin.restaurants.show', $restaurant)}}"class="btn btn-primary">show</a>

                <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">elimina</button>
                </form>
            </div>
        @endif

        @if(isset($error))
        <div class="alert alert-danger text-center" style="font-size: 1rem;">
            <h4>{{ $error }}</h4>
        </div>
        @endif
    </section>
</div>
@endsection
