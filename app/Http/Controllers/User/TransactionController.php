<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function cart(Request $request)
    {
        $categories = Category::where('status', 'active')->get();
        $search = $request->input('search', '');

        $carts = Cart::where('user_id', Auth::id())->get();
        $grand_total = $carts->sum('total');

        return view('pages.cart', compact('categories', 'search', 'carts', 'grand_total'));
    }

    public function addToCart(Request $request)
    {
        $user_id = Auth::id();
        $inventory = Inventory::find($request->inventory_id);
        $data = $request->all();

        $total = $data['quantity'] * $inventory->price;

        $data['user_id'] = $user_id;
        $data['total'] = $total;

        Cart::create($data);

        return redirect()->back();
    }

    public function deleteCartByID(string $id)
    {
        Cart::find($id)->delete();

        return redirect()->back();
    }

    public function deleteAllCart()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $categories = Category::where('status', 'active')->get();
        $search = $request->input('search', '');
        return view('pages.checkout', compact('categories', 'search'));
    }
}
