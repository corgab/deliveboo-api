@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(isset($error))
        <div class="alert alert-danger text-center" style="font-size: 1rem;">
            <h4>{{ $error }}</h4>
        </div>
    @endif
    @if(isset($restaurant))
        <section class="restaurant mb-5">
            <h1 class="restaurant-titles text-center text-md-start">IL TUO RISTORANTE</h1>
            <div class="card restaurant-card p-5">

                <h3>{{$restaurant->name}}</h3>
                <h4>{{$restaurant->address}}</h4>
                <p>P.IVA: {{$restaurant->vat}}</p>
                <ul class="p-0">
                    @foreach($restaurant->types as $type)
                        <li class="badge p-2 me-2">{{$type->name}}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="dishes mb-5">
            <h1 class="restaurant-titles text-center text-md-start">
                <a href="{{ route('admin.dishes.index') }}">I TUOI PIATTI</a>
            </h1>
            <div class="card restaurant-card p-5">
                @if($dishes->isEmpty())
                    <div>Non hai ancora nessun piatto registrato!</div>
                @else
                    @foreach($dishes as $dish)
                        <ul>
                            <li><i class="bi bi-check"></i>
                                {{$dish->name}}</li>
                        </ul>
                    @endforeach
                @endif
            </div>
        </section>

        <section class="orders mb-5">
            <h1 class="restaurant-titles text-center text-md-start">
                <a href="{{ route('admin.orders.index') }}">I TUO ORDINI</a>
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

        <section class="orders mb-5">
            <h1 class="restaurant-titles text-center text-md-start">
                <a href="{{ route('admin.orders.index') }}">STATISTICHE ORDINI</a>
            </h1>
            <div class="card restaurant-card p-5">
                @if($orders->isEmpty())
                    <div>Le statistche non sono disponibili. Non ci sono ordini.</div>
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
    @else
        <div class="row">
            <h1 class="h3 mb-4">
                Registra il tuo ristorante <br>
                Per poterlo gestire comodamente con un click.
            </h1>

            <form action="{{ url('admin/restaurants/create') }}" method="GET">
                <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-plus-square"></i>
                    {{ __('Registra il tuo ristorante') }}
                </button>
            </form>
        </div>



    @endif
</div>
@endsection