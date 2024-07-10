@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center mb-5 text-success">I tuoi ordini</h1>
    @if(isset($orders))
        <div class="row">
            @if($orders->isEmpty())
                <div>Non hai ancora nessun ordine!</div>
            @else
                @foreach($orders as $order)
                    <div class="col-12">
                        {{$order->name}}
                    </div>
                @endforeach
                <div class="mt-5">
                    <a href="{{ route('admin.orders.statistics')}}" class="btn btn-warning">STATISTICHE ORDINI</a>
                </div>
            @endif
        </div>
    @else
        <div class="row">
            <h1>
                Per poter gestire i tuoi ordini, registra il tuo ristoranteh</h1>

            <form action="{{ url('admin/restaurants/create') }}" method="GET">
                <button type="submit" class="btn btn-success btn-sm mt-4"><i class="bi bi-plus-square"></i>
                    {{ __('Registra il tuo ristorante') }}
                </button>
            </form>



        </div>
    @endif
</div>
@endsection