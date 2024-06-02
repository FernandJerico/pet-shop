@extends('dashboard.layouts.admin')

@section('content-section')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span> Edit</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Image</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            @if (isset($product->images) && $product->images->isNotEmpty())
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($product->images as $image)
                                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}"
                                        class="{{ $loop->first ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($product->images as $image)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ asset('storage/product/' . $image->url) }}" class="d-block w-100"
                                            alt="Product Image">
                                        <div class="carousel-caption d-none d-md-block">
                                            <form method="POST"
                                                action="{{ route('admin.product.image.delete', $image->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger shadow btn-xs sharp"
                                                    data-toggle="tooltip" title='Delete'
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bx bx-trash m-1"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
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
                            @else
                            <p>Image Not Found</p>
                            @endif

                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('admin.product.image.add', $product->id) }}" class="mt-3"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="container">
                                        <input type="file" name="image" id="image" class="form-control">
                                        <img id="preview-image" src="#" width="50%" class="visually-hidden">
                                        <button type="submit" class="btn icon icon-left btn-primary mt-2">
                                            <i data-feather="plus"></i> Tambah Foto
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <input type="radio" name="status" value="active" class="selectgroup-input" {{
                                        $product->status == 'active' ? 'checked' : '' }}>
                                    <span class="selectgroup-button">Active</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="inactive" class="selectgroup-input" {{
                                        $product->status == 'inactive' ? 'checked' : '' }}>
                                    <span class="selectgroup-button">Not Active</span>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("trix-file-accept", function(e) {
            e.preventDefault()
        })
</script>
<script type="text/javascript">
    ;(function($){
        function readURL(input) {
            var $prev = $('#preview-image');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                    reader.onload = function (e) {
                        $prev.attr('src', e.target.result);
                    }

                reader.readAsDataURL(input.files[0]);

                $prev.attr('class', 'mt-2');
            } else {
                $prev.attr('class', 'visually-hidden');
            }
        }

        $('#image').on('change',function(){
            readURL(this);
        });
    })(jQuery);
</script>
@endsection
