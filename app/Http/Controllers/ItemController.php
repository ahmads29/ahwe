<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Validator;

class ItemController extends Controller
{
    // Get all items
    // public function index()
    // {
    //     $items = Item::with('category')->get();
    //     return response()->json($items);
    // }
    public function index()
{
    $client = auth()->user();
    $items = Item::where('client_id', $client->id)->get();
    return response()->json($items);
}


    // Create a new item
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    // Update an item
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $item->update($request->all());
        return response()->json($item, 200);
    }

    // Delete an item
    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $item->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
