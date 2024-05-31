<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index
        $orderLists = OrderList::all();
        return view('dashboard.order-list.index', compact('orderLists'));
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
        //
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
        //update
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required',
            'size' => 'required',
            'unit' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        OrderList::findOrFail($id)->update($validatedData);

        return redirect()->route('admin.order-list.index')->with('success', 'Order list updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //destroy
        OrderList::findOrFail($id)->delete();

        return redirect()->route('admin.order-list.index')->with('success', 'Order list deleted successfully.');
    }
}
