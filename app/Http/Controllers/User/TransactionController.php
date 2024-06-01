<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function cart(Request $request)
    {
        $categories = Category::where('status', 'active')->get();
        $search = $request->input('search', '');
        return view('pages.cart', compact('categories', 'search'));
    }

    public function checkout(Request $request)
    {
        $categories = Category::where('status', 'active')->get();
        $search = $request->input('search', '');
        return view('pages.checkout', compact('categories', 'search'));
    }
}
