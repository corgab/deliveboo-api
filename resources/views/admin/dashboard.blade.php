@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-5 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Dashboard del ristoratore') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Sei correttamente loggato.') }}
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="bg-warning rounded mt-5 py-4">
            <h1 class="text-center fs-1 pt-5">Ciao e benvenuto in <span class="text-danger">Deliveboo</span>.
            </h1>
            <p class="my-4 fs-4 text-center px-5">Questa è la tua Dashboard. Da qui potrai sempre visionare il
                <strong>menù</strong> e <strong>lista completa</strong> dei tuoi piatti, gli <strong>ordini
                    ricevuti</strong> e le <strong>statistiche</strong> sugli ordini.
            </p>

            <div class="d-flex justify-content-center gap-5 mt-5 pb-5">
                <a href="{{ route('admin.dishes.index') }}" class="btn btn-danger">Menù e Lista Piatti</a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-danger">Ordini</a> 
                <a href="{{ route('admin.orders.index') }}" class="btn btn-danger">Statistiche</a>  
            </div>
        </div>
    </section>
</div>
@endsection