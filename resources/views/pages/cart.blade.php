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
                                        placeholder="" aria-label="Example text with button addon" id="qty"
                                        value="{{ $cart->quantity }}" aria-describedby="button-addon1"
                                        data-id="{{ $cart->id }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-outline-secondary plus-qty" type="button"
                                            id="button-addon1"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col text-right align-items-center d-flex justify-content-end">
                        <h4><b class="total-amount" data-id="{{ $cart->id }}">{{ number_format($cart->total) }}</b></h4>
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
            <a href="{{ route('checkout.preview') }}" class="btn btn-sm btn-flat btn-dark">Checkout</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.min-qty').click(function() {
            var cartId = $(this).closest('.cart-item').find('.cart-qty').data('id');
            var quantity = parseInt($(this).closest('.cart-item').find('.cart-qty').val());
            if (quantity > 1) {
                quantity--;
                updateCartQuantity(cartId, quantity);
            }
        });

        $('.plus-qty').click(function() {
            var cartId = $(this).closest('.cart-item').find('.cart-qty').data('id');
            var quantity = parseInt($(this).closest('.cart-item').find('.cart-qty').val());
            quantity++;
            updateCartQuantity(cartId, quantity);
        });

        $('.cart-qty').keyup(function() {
            var cartId = $(this).data('id');
            var quantity = parseInt($(this).val());
            updateCartQuantity(cartId, quantity);
        });

        function number_format(number, decimals, decPoint, thousandsSep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep,
                dec = (typeof decPoint === 'undefined') ? '.' : decPoint,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        function updateCartQuantity(cartId, quantity) {
            if (quantity == null || quantity == 0) {
                quantity = 0;
            }
            $.ajax({
                url: `/cart/update/qty`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: "PUT",
                    cart_id: cartId,
                    quantity: quantity
                },
                success: function(response) {
                    $(`input[data-id="${cartId}"]`).val(quantity);
                    $(`b.total-amount[data-id="${cartId}"]`).text(number_format(response.total));
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
@endsection
