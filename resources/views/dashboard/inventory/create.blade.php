@extends('dashboard.layouts.admin')

@section('content-section')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Inventory/</span> Create</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Inventory</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.inventories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Product</label>
                            <select class="form-select @error('product_id') is-invalid @enderror" name="product_id"
                                id="product_id">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="quantity">Quantity</label>
                            <input type="text" class="form-control @error('quantity')
                                is-invalid
                            @enderror" id="quantity" placeholder="Masukkan Quantity" name="quantity" />
                            @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="unit">Unit</label>
                            <input type="text" class="form-control @error('unit')
                                is-invalid
                            @enderror" id="unit" placeholder="Masukkan Unit" name="unit" />
                            @error('unit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="price">Price</label>
                            <input type="text" class="form-control @error('price')
                                is-invalid
                            @enderror" id="price" placeholder="Masukkan Harga" name="price" />
                            @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="size">Size</label>
                            <input type="text" class="form-control @error('size')
                                is-invalid
                            @enderror" id="size" placeholder="Masukkan Size" name="size" />
                            @error('size')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
