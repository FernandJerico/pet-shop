<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index
        $subcategories = Subcategory::with('category')->get();
        return view('dashboard.sub-category.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create
        $categories = Category::all();
        return view('dashboard.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        SubCategory::create($request->all());
        return redirect()->route('sub-categories.index')->with('success', 'Sub Category created successfully.');
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
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.sub-category.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);
        
        SubCategory::findOrFail($id)->update($request->all());

        return redirect()->route('sub-categories.index')->with('success', 'Sub Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //destroy
        SubCategory::findOrFail($id)->delete();
        return redirect()->route('sub-categories.index')->with('success', 'Sub Category deleted successfully.');
    }
}