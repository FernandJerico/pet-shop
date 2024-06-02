<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderList;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index
        $transactions = Transaction::with('user', 'transactionDetails')->get();

        return view('dashboard.order-list.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create
        return view('dashboard.order-list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required',
            'size' => 'required',
            'unit' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        OrderList::create($validatedData);

        return redirect()->route('admin.order-list.index')->with('success', 'Order list created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with('user', 'transactionDetails')->findOrFail($id);
        $details = $transaction->transactionDetails;

        return view('dashboard.order-list.detail', compact('transaction', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //edit
        $orderList = OrderList::findOrFail($id);
        return view('dashboard.order-list.edit', compact('orderList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);
        if ($request->status == 'cancel') {
            foreach ($transaction->transactionDetails as $detail) {
                $inventory = $detail->inventory;
                $inventory->quantity += $detail->quantity;
                $inventory->save();
            }
        }
        $transaction->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $orderList = Transaction::findOrFail($id);

            $orderList->delete();

            return redirect()->route('admin.order-list.index')->with('success', 'Order list deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.order-list.index')->with('error', 'Order list Gagal dihapus!!');
        }
    }

    public function markAsPaid(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['paid' => 1]);

        return redirect()->route('admin.order-list.index')->with('success', 'Order list marked as paid.');
    }
}
