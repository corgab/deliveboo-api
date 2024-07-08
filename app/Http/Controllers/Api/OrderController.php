<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Braintree_Transaction;
use Braintree\Gateway;

class OrderController extends Controller
{
    
    public function checkout(Request $request, Gateway $gateway)
    {
        // Importo totale
        $amount = $request->input('total_price');
        $nonce = $request->input('paymentMethodNonce');

        // Transazione di vendita 
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        // Traduzione errori in italiano (opzionale)

        if ($result->success) {
            // Salvo nel db i dati
            $order = Order::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'number' => $request->input('number'),
                'address' => $request->input('address'),
                'total_price' => $amount,
                'restaurant_id' => $request->input('restaurant_id'),
            ]);

            // Logica piatti

            return response()->json(['success' => true, 'order' => $order]); // Da verificare 'transaction' => $result->transaction
        } else {
            return response()->json(['success' => false, 'error' => $result->message]);
        }
    }

}
