@extends('layouts.main')

@section('main-content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">

                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0 " loading="lazy" id="display-img"
                        src="{{ asset('storage/product/' . $product->images->first()->url) }}" alt="product" />
                    <div class="mt-2 row gx-2 gx-lg-3 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
                        @foreach ($product->images as $image)
                            <a href="javascript:void(0)" class="view-image"
                                data-url="{{ asset('storage/product/' . $image->url) }}"><img
                                    src="{{ asset('storage/product/' . $image->url) }}" loading="lazy" class="img-thumbnail"
                                    alt=""></a>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $product->product_name }}</h1>
                    @if (isset($product->inventories) && $product->inventories->isNotEmpty())
                        <div class="mb-5">
                            <img src="{{ asset('assets/img/icons/rp-symbol.png') }}" alt="rp" width="18px">.
                            <span id="price">
                                {{ number_format($product->inventories->first()->price, 0, ',', '.') }}</span>
                            <br>
                            <span><small><b>Available stock:</b> <span
                                        id="avail">{{ $product->inventories->first()->quantity }}</span></small></span>
                        </div>
                    @else
                        <div class="fs-5 mb-5">
                            <h5>OUT OF STOCK</h5>
                        </div>
                    @endif

                    <div class="fs-5 mb-5 d-flex justify-content-start">
                        @foreach ($product->inventories as $inventory)
                            <span><button
                                    class="btn btn-sm btn-flat btn-outline-dark m-2 p-size {{ $loop->first ? 'active' : '' }}"
                                    data-id="{{ $inventory->id }}">{{ $inventory->size }}</button></span>
                        @endforeach
                    </div>
                    <form action="{{ route('cart.add') }}" method="POST" id="add-cart">
                        @csrf
                        <div class="d-flex">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="inventory_id" value="" id="inventory">
                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                                style="max-width: 3rem" name="quantity"
                                {{ $product->inventories->isEmpty() ? 'disabled' : '' }} />
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit"
                                {{ $product->inventories->isEmpty() ? 'disabled' : '' }}>
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </form>
                    <p class="lead">{!! $product->description !!}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($relatedProducts as $related_product)
                    <div class="col mb-5">
                        <div class="card h-100 product-item">
                            <!-- Product image-->
                            <img class="card-img-top w-100"
                                src="{{ $related_product->images->first() ? asset('storage/product/' . $related_product->images->first()->url) : asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                                alt="related" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $related_product->product_name }}</h5>
                                    <!-- Product price-->
                                    @if ($related_product->inventories->isNotEmpty())
                                        @foreach ($related_product->inventories as $item)
                                            <span><b>{{ $item->size }}: </b>Rp
                                                {{ number_format($item->price, 0, ',', '.') }}</span>
                                        @endforeach
                                    @else
                                        <span><b>OUT OF STOCK</b></span>
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-flat btn-primary "
                                        href="{{ route('product.detail', $related_product->id) }}">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.view-image').click(function() {
                var imageUrl = $(this).data('url');

                $('#display-img').attr('src', imageUrl);
            });
        });
    </script>
    <script>
        function updatePriceAndStock(sizeId) {
            const inventory = @json($product->inventories);

            const selectedInventory = inventory.find(item => item.id == sizeId);

            document.getElementById('price').textContent = selectedInventory.price.toLocaleString('id-ID');
            document.getElementById('avail').textContent = selectedInventory.quantity;
            document.getElementById('inventory').value = selectedInventory.id;
        }

        const sizeButtons = document.querySelectorAll('.p-size');
        sizeButtons.forEach(button => {
            button.addEventListener('click', function() {
                sizeButtons.forEach(btn => btn.classList.remove('active'));

                this.classList.add('active');

                updatePriceAndStock(this.dataset.id);
            });
        });

        updatePriceAndStock({{ $product->inventories->first()->id ?? 0 }});
    </script>
@endsection
