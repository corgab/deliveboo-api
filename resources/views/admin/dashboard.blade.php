@extends('layouts.app')

@section('content')
<div class="container py-5">
    <section class="restaurant mb-5">
        <h1 class="restaurant-titles">IL TUO RISTORANTE</h1>
        <div class="card restaurant-card p-5">
        @if($restaurant)
            <h3>{{$restaurant->name}}</h3>
            <h4>{{$restaurant->address}}</h4>
            <p>P.IVA: {{$restaurant->vat}}</p>
        </div>

        @else
        <div>Non hai ancora nessun Ristorante registrato!</div>
        @endif
    </section>

    <section class="dishes mb-5">
        <h1 class="restaurant-titles">
            <a href="{{ route('admin.dishes.index') }}">I TUOI PIATTI</a>
        </h1>
        <div class="card restaurant-card p-5">
            @if($dishes)
            @foreach($dishes as $dish)
            <ul>
                <li>{{$dish->name}}</li>
            </ul>
            @endforeach
            @else
            <div>Non hai ancora nessun piatto registrato!</div>
            @endif
        </div>
    </section>

    <section class="orders mb-5">
        <h1 class="restaurant-titles">
            <a href="{{ route('admin.orders.index') }}">IL TUO ORDINI</a>
        </h1>
        <div class="card restaurant-card p-5">
            @if($orders)
            @foreach($orders as $order)
            <ul>
                <li class="d-flex justify-content-between">
                    <p>{{$order->name}}</p>
                    <p>{{$order->total_price}}</p>
                </li>
            </ul>
            @endforeach
            @else
            <div>Non hai ancora nessun ordine!</div>
            @endif
        </div>
    </section>

    <section class="order-statistics mb-5">
        <h1 class="restaurant-titles">STATISTICHE ORDINI</h1>
    </section>
</div>
@endsection