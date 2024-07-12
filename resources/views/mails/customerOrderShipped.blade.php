<!DOCTYPE html>
<html>
<head>
    <title>Ordine ricevuto</title>
</head>
<body>
    <!-- class="d-flex justify-content-center align-items-center" -->
    <div>
        <h1>Grazie per il tuo ordine, {{ $order->name }}!</h1>
        <h4>Dettagli Ordine:</h4>
        <!-- <p>Ristorante: {{ $restaurant->name }}</p> -->
        <p>Totale: {{ $order->total_price }} €</p>
    </div>
</body>