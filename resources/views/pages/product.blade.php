@extends('layouts.main')

@section('main-content')
    <div class="bg-dark py-5" id="main-header">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">{{ $category->name }}</h1>
                @if (isset($subcategory))
                    <p class="lead fw-normal text-white-50 mb-0">{{ $subcategory->name }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="container px-4 px-lg-5 mt-5">
        @if ($products->isEmpty())
            <div class="row gx-4 gx-lg-5 justify-content-center p-5">
                <div class="col-md-8 p-5">
                    <div class="alert alert-warning text-center" role="alert">
                        Data tidak ditemukan
                    </div>
                </div>
            </div>
        @else
            <div class="row gx-4 gx-lg-5 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100 product-item">
                            <!-- Product image-->
                            <img class="card-img-top w-100"
                                src="{{ asset('storage/product/' . $product->images->first()->url) }}"
                                alt="Product Image" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                    <!-- Product price-->
                                    @foreach ($inventory->where('product_id', $product->id) as $item)
                                        <span><b>{{ $item->size }}: </b>Rp
                                            {{ number_format($item->price, 0, ',', '.') }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-flat btn-primary"
                                        href="{{ route('product.detail', $product->id) }}">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var mainHeader = document.getElementById('main-header');
            var coverImage =
                '{{ !empty($meta['cover']) ? Storage::url($meta['cover']) : asset('assets/img/default-cover.png') }}';
            mainHeader.style.backgroundImage = 'url(' + coverImage + ')';
            mainHeader.style.backgroundSize = 'cover';
            mainHeader.style.backgroundPosition = 'center';
        });
    </script>
@endsection
