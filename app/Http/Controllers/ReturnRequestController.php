<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnRequest;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class ReturnRequestController extends Controller
{
    /**
     * Submit a return request for an order item
     */
    public function submitReturnRequest(Request $request, $orderItemId)
    {
        if (!Auth::check()) {
            return redirect()->route('signin')->with('error', 'You must log in first.');
        }

        $user = Auth::user();
        if (!$user->customer) {
            return redirect()->route('orders.index')->with('error', 'Customer profile not found.');
        }

        $orderItem = OrderItem::findOrFail($orderItemId);
        
        // Verify the order item belongs to the current customer
        if ($orderItem->order->Customer_ID != $user->customer->Customer_ID) {
            return redirect()->route('orders.index')->with('error', 'Unauthorized.');
        }

        // Check if return already exists - prevent duplicate submissions
        $existing = ReturnRequest::where('OrderItem_ID', $orderItemId)->first();
        if ($existing) {
            return redirect()->route('orders.show', $orderItem->FinalOrder_ID)
                ->with('warning', 'Return request already submitted for this item. Status: ' . ucfirst($existing->Status));
        }

        $validated = $request->validate([
            'reason' => 'required|string|min:10|max:500',
        ]);

        ReturnRequest::create([
            'OrderItem_ID' => $orderItemId,
            'Reason' => $validated['reason'],
            'Status' => 'pending',
        ]);

        return redirect()->route('orders.show', $orderItem->FinalOrder_ID)
            ->with('success', 'Return request submitted successfully. We will review it shortly.');
    }

    /**
     * Display a listing of all return requests (admin only).
     */
    public function index() {
        $returns = ReturnRequest::with('orderItem.product')->orderBy('created_at', 'desc')->get();
        return view('returns.index', compact('returns'));
    }

    /**
     * Display the specified return request.
     */
    public function show($id) {
        $return = ReturnRequest::findOrFail($id);
        return view('returns.show', compact('return'));
    }
}
