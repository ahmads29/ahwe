<?php

// app/Http/Controllers/ReceiptController.php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\Order;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    // public function index()
    // {
    //     return Receipt::all();
    // }

    public function index()
{
    $client = auth()->user();
    $receipts = Receipt::where('client_id', $client->id)->get();
    return response()->json($receipts);
}


    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::with('items')->find($request->order_id);

        $receiptData = [
            'order_id' => $order->id,
            'total' => $order->total,
            'items' => $order->items->map(function ($item) {
                return [
                    'name' => $item->name,
                    'quantity' => $item->pivot->quantity,
                    'price' => $item->pivot->price,
                ];
            }),
        ];

        $receipt = Receipt::create([
            'order_id' => $order->id,
            'receipt_data' => json_encode($receiptData),
        ]);

        return $receipt;
    }

    public function show(Receipt $receipt)
    {
        return [
            'order_id' => $receipt->order_id,
            'receipt_data' => json_decode($receipt->receipt_data, true),
        ];
    }
}
