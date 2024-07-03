@extends('layouts.app')
@section('content')
<div class="container">
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
    <div>
        <a href="{{ route('admin.orders.statistics')}}" class="btn btn-warning">STATISTICHE ORDINI</a>
    </div>
    @endif
    </div>
@else
<div class="row">
    <h1>
        PER POTER GESTIRE I TUOI ORDINI, REGISTRA IL TUO RISTORANTE! <br>
        <a class="dropdown-item btn" href="{{ url('admin/restaurant/create') }}">{{__('Registra il tuo Ristorante')}}</a>
    </h1>
</div>
@endif
</div>
@endsection
