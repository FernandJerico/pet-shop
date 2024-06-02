<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index
        $products = Product::with('category', 'subcategory')->get();
        return view('dashboard.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create
        $categories = Category::with('subCategories')->get();
        return view('dashboard.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'product_name' => 'required',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
            'images' => 'required',
            'images.*' => 'mimes:png,jpg,jpeg|max:5048'
        ]);

        $validatedData['image'] = $request->images[0]->hashName();
        $product = Product::create($validatedData);

        foreach ($request->file('images') as $image) {
            $image->storeAs('public/product', $image->hashName());

            ProductImage::create([
                'product_id' => $product->id,
                'url' => $image->hashName()
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
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
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::with('subCategories')->get();
        return view('dashboard.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //update
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'product_name' => 'required',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
            'image' => 'image|max:2048',
        ]);

        // Periksa apakah ada foto baru diunggah
        if ($request->hasFile('image')) {
            // Hapus foto lama dari storage
            Storage::delete($product->image);

            // Simpan foto baru di dalam storage
            $validatedData['image'] = $request->file('image')->storeAs('public/product-image', $validatedData['product_name'] . '.' . $request->file('image')->getClientOriginalExtension());
        }


        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //destroy
        $product = Product::find($id);
        //delete image from storage
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
