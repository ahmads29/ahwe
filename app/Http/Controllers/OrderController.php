<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::with('items')->get();
    }

    public function store(Request $request){
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:items,id',
            'item.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;

        DB:transaction(function () use ($request, &$total)
        {
            $order = Order::create(['total' => 0]);
            
            foreach($request->items as $itemData){
                $item = Item::find($itemData['id']);
                $quantity = $itemData['quantity'];
                $price = $item->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $total += $price;
            }
            $order->update(['total' => $total]);
        });

        return response()->json(['message' => 'Order created successfully', 'total' => $total]);
    }

    public function show(Order $order)
    {
        return $order->load('items');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
    
}
