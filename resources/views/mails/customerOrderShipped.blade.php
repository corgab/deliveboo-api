<!DOCTYPE html>
<html>
<head>
    <title>Ordine ricevuto</title>
    <style>
        ul,li {
            list-style: none
        }
    </style>
</head>
<body>
    <!-- class="d-flex justify-content-center align-items-center" -->
    <div>
        <h1>Grazie per il tuo ordine, {{ $order->name }}!</h1>
        <h4>Dettagli Ordine:</h4>
        <ul>
        @foreach($order->dishes as $dish)
           <li>{{$dish->name}} | €{{$dish->price}}</li>
        @endforeach
        </ul> 
        <p>Totale: €{{ $order->total_price }}</p>
    </div>
</body>

