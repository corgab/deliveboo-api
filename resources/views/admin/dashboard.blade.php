@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-5 text-secondary my-4 text-center">
        {{ __('Dashboard') }}
    </h2>

    <section>
        @if (isset($error))
            <div class="alert alert-danger text-center" style="font-size: 1rem;">
                {{ $error }}
            </div>
        @else
            <div class="mt-5 py-4">
                <h1 class="text-center text-white fs-1 pt-5">Ciao e benvenuto in <span class="text-danger">Deliveboo</span>.
                </h1>
                <p class="my-4 fs-4 text-center text-white px-5">Questa è la tua Dashboard. Da qui potrai sempre visionare il
                    <strong>menù</strong> e <strong>lista completa</strong> dei tuoi piatti, gli <strong>ordini
                        ricevuti</strong> e le <strong>statistiche</strong> sugli ordini.
                </p>

                <div class="d-flex justify-content-center gap-4 mt-5 pb-5">
                    <a href="{{ route('admin.dishes.index') }}" class="btn btn-danger">Menù</a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-danger">Ordini</a> 
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-danger">Statistiche</a>  
                </div>
            </div>
        @endif
    </section>
</div>
@endsection