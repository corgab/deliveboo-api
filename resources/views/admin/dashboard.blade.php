@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(isset($error))
        <div class="alert alert-danger text-center" style="font-size: 1rem;">
            <h4>{{ $error }}</h4>
        </div>
    @endif
    @if(isset($restaurant))
        <section class="restaurant mb-5 d-flex align-items-center">
                <div class="w-25">
                    <img class="restaurant-img" src="{{ asset('storage/' . $restaurant->thumb) }}" alt="">
                </div>
                <div class="w-75">
                    <div class="card restaurant-card p-5">
                        <h3>{{$restaurant->name}}</h3>
                        <h4>{{$restaurant->address}}</h4>
                        {{-- <p>P.IVA: {{$restaurant->vat}}</p> --}}
                        <ul class="p-0 my-3">
                            <h5>Tipologie:</h5>
                            @foreach($restaurant->types as $type)
                                <li class="badge p-2 me-2">{{$type->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
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
                            @if($dish->visible === 1)
                            <li><i class="bi bi-check"></i>
                            @else
                            <li><i class="bi bi-x"></i>
                            @endif
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
                <div class="table-responsive my-2">
                    <table class="table orders-table ">
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
                </div>
                    
                <!-- Link di paginazione -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        @if ($orders->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">&laquo;</a>
                            </li>
                        @endif

                        @if ($orders->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
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