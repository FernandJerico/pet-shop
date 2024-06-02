@extends('dashboard.layouts.admin')

@section('content-section')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hi,
                <span>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span></h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4 d-flex justify-content-center align-items-center">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Carousel Product</h5>
                    </div>
                    <div class="card-body col-md-6">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($products as $product)
                                    @foreach ($product->images as $image)
                                        <li data-bs-target="#carouselExampleCaptions"
                                            data-bs-slide-to="{{ $loop->parent->index }}"
                                            class="{{ $loop->parent->first && $loop->first ? 'active' : '' }}"></li>
                                    @endforeach
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($products as $product)
                                    @foreach ($product->images as $image)
                                        <div
                                            class="carousel-item {{ $loop->parent->first && $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset('storage/product/' . $image->url) }}" class="d-block w-100"
                                                alt="Product Image">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
