<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CustomerOrderShipped;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Http\Request;
use Braintree_Transaction;
use Braintree\Gateway;
use Illuminate\Support\Facades\Mail;

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
                'submitForSettlement' => true
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
            $dishes = $request->input('dishes');
    
            // Assicuriamoci che 'dishes' sia un array
            if (!is_array($dishes)) {
                return response()->json(['success' => false, 'error' => 'Dati dei piatti non validi.']);
            }
    
            foreach ($dishes as $dish) {
                // Verifica se il piatto esiste nel database
                $dishId = $dish['id'];
                $qty = $dish['qty'];
    
                $existingDish = Dish::find($dishId);
                if ($existingDish) {
                    $order->dishes()->attach($existingDish, ['qty' => $qty]);
                }
            }
    
            Mail::to($order->email)->send(new CustomerOrderShipped($order));
    
            return response()->json(['success' => true, 'order' => $order]);
        } else {
            return response()->json(['success' => false, 'error' => $result->message]);
        }
    }

}
