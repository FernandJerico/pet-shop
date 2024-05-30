<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index
        $inventories = Inventory::all();
        return view('dashboard.inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create
        $products = Product::all();
        return view('dashboard.inventory.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'size' => 'required',
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventories.index')->with('success', 'Inventory created successfully.');
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
        $inventory = Inventory::find($id);
        $products = Product::all();
        return view('dashboard.inventory.edit', compact('inventory', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'size' => 'required',
        ]);

        $inventory = Inventory::find($id);
        $inventory->update($request->all());
        
        return redirect()->route('inventories.index')->with('success', 'Inventory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //destroy
        $inventory = Inventory::find($id);
        $inventory->delete();
        
        return redirect()->route('inventories.index')->with('success', 'Inventory deleted successfully.');
    }
}