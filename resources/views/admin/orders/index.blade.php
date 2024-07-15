@extends('layouts.app')
@section('content')
<div class="container">
    @if(isset($orders))
        <div class="row">
            @if($orders->isEmpty())
                <h1 class="text-center mb-5 text-success">Non hai ancora nessun ordine!</h1>
            @else
            <h1 class="text-center mb-5 text-success">I tuoi ordini</h1>
            <div class="table-responsive my-2">
                <table class="table orders-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Prezzo Totale</th>
                            <th>Indirizzo</th>
                            <th>Piatti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <th scope="row">{{$order->name}}</td>
                            <td>{{$order->total_price}} €</td>
                            <td>{{$order->address}}</td>
                            <td>
                                @foreach($order->dishes as $dish)
                                <i class="bi bi-caret-right"></i> {{$dish->name}} {{$dish->pivot->qty}} € <br>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @else
        <div class="row">
            <h1>
                Per poter gestire i tuoi ordini, registra il tuo ristorante</h1>

            <form action="{{ url('admin/restaurants/create') }}" method="GET">
                <button type="submit" class="btn btn-success btn-sm mt-4"><i class="bi bi-plus-square"></i>
                    {{ __('Registra il tuo ristorante') }}
                </button>
            </form>



        </div>
    @endif
</div>
@endsection