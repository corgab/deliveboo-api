@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(isset($restaurant))
        <section class="restaurant mb-5">
            <h1 class="restaurant-titles">IL TUO RISTORANTE</h1>
            <div class="card restaurant-card p-5">
            
                <h3>{{$restaurant->name}}</h3>
                <h4>{{$restaurant->address}}</h4>
                <p>P.IVA: {{$restaurant->vat}}</p>
            </div>
        </section>

        <section class="dishes mb-5">
            <h1 class="restaurant-titles">
                <a href="{{ route('admin.dishes.index') }}">I TUOI PIATTI</a>
            </h1>
            <div class="card restaurant-card p-5">
                @if($dishes->isEmpty())
                    <div>Non hai ancora nessun piatto registrato!</div>
                @else
                    @foreach($dishes as $dish)
                    <ul>
                        <li>{{$dish->name}}</li>
                    </ul>
                    @endforeach
                @endif
            </div>
        </section>

        <section class="orders mb-5">
            <h1 class="restaurant-titles">
                <a href="{{ route('admin.orders.index') }}">IL TUO ORDINI</a>
            </h1>
            <div class="card restaurant-card p-5">
            @if($orders->isEmpty())
                <div>Non hai ancora nessun ordine!</div>
            @else
                @foreach($orders as $order)
                <ul>
                    <li class="d-flex justify-content-between">
                        <p>{{$order->name}}</p>
                        <p>{{$order->total_price}} €</p>
                    </li>
                </ul>
                @endforeach
            @endif
            </div>
        </section>

        <section class="order-statistics mb-5">
            <h1 class="restaurant-titles">STATISTICHE ORDINI</h1>
        </section>
    @else
        <div class="row">
            <h1>
                REGISTRA IL TUO RISTORANTE! <br>
                PER POTER GESTIRE IL TUTTO QUI NELLA DASHBOARD!!
                <a class="dropdown-item btn" href="{{ url('admin/restaurants/create') }}">{{__('Registra il tuo Ristorante')}}</a>
            </h1>
        </div>
    @endif
</div>
@endsection