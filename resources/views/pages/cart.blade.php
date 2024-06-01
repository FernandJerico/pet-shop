@extends('layouts.main')

@section('main-content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-end mb-2">
                <form action="{{ route('cart.delete') }}" method="POST">
                    @method('delete')
                    @csrf
                    <button onclick="return confirm('Are you sure?')" class="btn btn-outline-dark btn-flat btn-sm"
                        id="empty_cart">
                        Empty Cart
                    </button>
                </form>
            </div>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <h3><b>Cart List</b></h3>
                <hr class="border-dark">
                @foreach ($carts as $cart)
                <div class="d-flex w-100 justify-content-between  mb-2 py-2 border-bottom cart-item">
                    <div class="d-flex align-items-center col-8">
                        <form action="{{ route('cart.delete.id', $cart->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button onclick="return confirm('Are you sure?')">
                                <span class="mr-2"><a class="btn btn-sm btn-outline-danger rem_item"
                                        data-id="{{ $cart->id }}"><i class="fa fa-trash"></i></a></span>
                            </button>
                        </form>

                        <img src="{{ Storage::url($cart->product->image) }}" loading="lazy"
                            class="cart-prod-img mr-2 mr-sm-2 border" alt="">
                        <div>
                            <p class="mb-1 mb-sm-1">{{ $cart->product->product_name }}</p>
                            <p class="mb-1 mb-sm-1"><small><b>Size:</b> {{ $cart->inventory->size }}</small></p>
                            <p class="mb-1 mb-sm-1"><small><b>Price:</b> <span class="price">{{
                                        number_format($cart->inventory->price) }}</span></small></p>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-outline-secondary min-qty" type="button"
                                            id="button-addon1"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <input type="number" class="form-control form-control-sm qty text-center cart-qty"
                                        placeholder="" aria-label="Example text with button addon"
                                        value="{{ $cart->quantity }}" aria-describedby="button-addon1"
                                        data-id="{{ $cart->id }}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-outline-secondary plus-qty" type="button"
                                            id="button-addon1"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-right align-items-center d-flex justify-content-end">
                        <h4><b class="total-amount">{{ number_format($cart->total) }}</b></h4>
                    </div>
                </div>
                @endforeach
                <div class="d-flex w-100 justify-content-between mb-2 py-2 border-bottom">
                    <div class="col-8 d-flex justify-content-end">
                        <h4>Grand Total:</h4>
                    </div>
                    <div class="col d-flex justify-content-end">
                        @if (isset($cart))
                        <h4 id="grand-total">{{ number_format($grand_total) }}</h4>
                        @else
                        <h4 id="grand-total">-</h4>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex w-100 justify-content-end mt-2">
            <a href="#" class="btn btn-sm btn-flat btn-dark">Checkout</a>
        </div>
    </div>
</div>
@endsection
