<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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
        $cart = Cart::where('user_id', $user_id)->where('inventory_id', $inventory->id)->first();
        $data = $request->all();

        $total = $data['quantity'] * $inventory->price;

        $data['user_id'] = $user_id;
        $data['total'] = $total;

        if ($cart) {
            $cart->quantity += $data['quantity'];
            $cart->total += $total;
            $cart->save();
        } else {
            Cart::create($data);
        }

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

    public function updateQTY()
    {
        $data = request()->all();
        $cart = Cart::find($data['cart_id']);
        $inventory = Inventory::find($cart->inventory_id);

        $total = $data['quantity'] * $inventory->price;

        $cart->quantity = $data['quantity'];
        $cart->total = $total;
        $cart->save();

        // json
        return response()->json([
            'total' => $total,
            'qty' => $cart->quantity,
        ]);
    }

    public function checkoutPreview(Request $request)
    {
        $categories = Category::where('status', 'active')->get();
        $search = $request->input('search', '');

        $carts = Cart::where('user_id', Auth::id())->get();
        $grand_total = $carts->sum('total');

        return view('pages.checkout', compact('categories', 'search', 'grand_total'));
    }

    public function checkout(Request $request)
    {
        $categories = Category::where('status', 'active')->get();
        $search = $request->input('search', '');

        $carts = Cart::where('user_id', Auth::id())->get();
        $grand_total = $carts->sum('total');

        if (isset($request->cod)) {
            $payment_method = 'Cash on Delivery';
        } else {
            $payment_method = 'Whatsapp';
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'delivery_address' => $request->delivery_address,
            'payment_method' => $payment_method,
            'amount' => $grand_total,
            'status' => 'pending',
            'paid' => 0,
        ]);

        foreach ($carts as $cart) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'user_id' => Auth::id(),
                'inventory_id' => $cart->inventory_id,
                'quantity' => $cart->quantity,
                'total' => $cart->total,
            ]);

            Cart::destroy($cart->id);
        }

        return redirect()->route('index')->with('success', 'Checkout successfully.');
    }
}
