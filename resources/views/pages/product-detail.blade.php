@extends('layouts.main')

@section('main-content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0 " loading="lazy" id="display-img"
                    src="{{ Storage::url($product->image) }}" alt="product" />
                <div class="mt-2 row gx-2 gx-lg-3 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
                    {{-- @foreach ($fileO as $k => $img)
                    @if (!in_array($img, ['.', '..']))
                    <a href="javascript:void(0)" class="view-image {{ $k == 2 ? 'active' : '' }}"><img
                            src="{{ validate_image('uploads/product_' . $id . '/' . $img) }}" loading="lazy"
                            class="img-thumbnail" alt=""></a>
                    @endif
                    @endforeach --}}
                    <a href="javascript:void(0)" class="view-image"><img src="{{ Storage::url($product->image) }}"
                            loading="lazy" class="img-thumbnail" alt=""></a>
                </div>
            </div>
            <div class="col-md-6">
                @php
                $inventory = App\Models\Inventory::where('product_id', $product->id)->get();
                @endphp
                <h1 class="display-5 fw-bolder">{{ $product->product_name }}</h1>
                <div class="fs-5 mb-5">
                    &#8369; <span id="price">Rp {{ number_format($inventory->first()->price, 0, ',', '.') }}</span>
                    <br>
                    <span><small><b>Available stock:</b> <span id="avail">{{ $inventory->first()->quantity
                                }}</span></small></span>
                </div>
                <div class="fs-5 mb-5 d-flex justify-content-start">
                    @foreach ($inventory as $item)
                    <span><button
                            class="btn btn-sm btn-flat btn-outline-dark m-2 p-size {{ $loop->first ? 'active' : '' }}"
                            data-id="{{ $item->id }}">{{ $item->size }}</button></span>
                    @endforeach
                </div>
                <form action="" id="add-cart">
                    <div class="d-flex">
                        <input type="hidden" name="price" value="#">
                        <input type="hidden" name="inventory_id" value="#">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                            style="max-width: 3rem" name="quantity" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
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
                    <img class="card-img-top w-100" src="{{ Storage::url($related_product->image) }}" alt="related" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{ $related_product->product_name }}</h5>
                            <!-- Product price-->
                            @if ($related_product->inventory)
                            @foreach ($related_product->inventory as $item)
                            @if ($item->product_id == $related_product->id)
                            <span><b>{{ $item->size }}: </b>Rp
                                {{ number_format($item->price, 0, ',', '.') }}</span>
                            @endif
                            @endforeach
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

<script>
    function updatePriceAndStock(sizeId) {
            const inventory = @json($inventory);

            const selectedInventory = inventory.find(item => item.id == sizeId);

            document.getElementById('price').textContent = selectedInventory.price.toLocaleString('id-ID');
            document.getElementById('avail').textContent = selectedInventory.quantity;
        }

        const sizeButtons = document.querySelectorAll('.p-size');
        sizeButtons.forEach(button => {
            button.addEventListener('click', function() {
                sizeButtons.forEach(btn => btn.classList.remove('active'));

                this.classList.add('active');

                updatePriceAndStock(this.dataset.id);
            });
        });

        updatePriceAndStock({{ $inventory->first()->id }});
</script>
@endsection
