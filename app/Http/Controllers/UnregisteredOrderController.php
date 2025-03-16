<?php

namespace App\Http\Controllers;

use App\Models\UnregisteredOrder;
use Illuminate\Http\Request;

class UnregisteredOrderController extends Controller
{
    public function update(Request $request, $id): JsonResponse
    {
        // Validate the incoming request data
        $request->validate([
            'paid' => 'required|boolean',
            'delivered' => 'required|boolean',
            'delivery_date' => 'nullable|date',
        ]);

        // Find the unregistered order by ID
        $unregisteredOrder = UnregisteredOrder::findOrFail($id);

        // Update the order's attributes
        $unregisteredOrder->paid = $request->input('paid');
        $unregisteredOrder->delivered = $request->input('delivered');
        $unregisteredOrder->delivery_date = $request->input('delivery_date');

        // Save the changes to the database
        $unregisteredOrder->save();

        // Return a success response
        return response()->json(['success' => true]);
    }
}