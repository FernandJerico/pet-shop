@extends('dashboard.layouts.admin')

@section('content-section')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span> Edit</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="product_name">Product Name</label>
                            <input type="text" class="form-control @error('product_name')
                                is-invalid
                            @enderror" id="product_name" placeholder="Royal Canin" name="product_name"
                                value="{{ $product->product_name }}" />
                            @error('product_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="category">Category Product</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                id="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ?
                                    'selected' : '' }}>
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="sub-category">Sub Category Product</label>
                            <select class="form-select @error('sub_category_id') is-invalid @enderror"
                                name="sub_category_id" id="sub-category">
                                <option value="">Select Sub Category</option>
                                @foreach ($categories as $category)
                                @foreach ($category->subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" data-category="{{ $category->id }}" {{ $product->
                                    sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                    {{ $subCategory->name }}</option>
                                @endforeach
                                @endforeach
                            </select>
                            @error('sub_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input id="description" type="hidden" name="description"
                                value="{{ $product->description }}">
                            <trix-editor input="description"></trix-editor>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="active" class="selectgroup-input" @if
                                        ($product->status == 'active') checked @endif>
                                    <span class="selectgroup-button">Active</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="inactive" class="selectgroup-input" @if
                                        ($product->status == 'inactive') checked @endif>
                                    <span class="selectgroup-button">Not Active</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            @if ($product->image)
                            <p>Current Image: {{ $product->image }}</p>
                            @endif
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="image">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("trix-file-accept", function(e) {
            e.preventDefault()
        })
</script>
@endsection
