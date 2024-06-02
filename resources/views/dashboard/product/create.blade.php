@extends('dashboard.layouts.admin')

@section('content-section')
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">There's something wrong!</h4>
    <hr>
    <p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    </p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span> Create</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="product_name">Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                id="product_name" placeholder="Royal Canin" name="product_name"
                                value="{{ old('product_name') }}" />
                            @error('product_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="category">Category Product</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                id="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <option value="{{ $subCategory->id }}" data-category="{{ $category->id }}">
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
                            <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                            <trix-editor input="description"></trix-editor>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="active" class="selectgroup-input"
                                        checked="">
                                    <span class="selectgroup-button">Active</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="inactive" class="selectgroup-input">
                                    <span class="selectgroup-button">Inactive</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Image</label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror" multiple
                                name="images[]">
                            @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
            $('#category').change(function() {
                var selectedCategoryId = $(this).val();
                var hasSubCategory = false;

                $('#sub-category option').each(function() {
                    var categoryData = $(this).data('category');
                    if (categoryData == selectedCategoryId || categoryData == '') {
                        $(this).show();
                        hasSubCategory = true;
                    } else {
                        $(this).hide();
                    }
                });

                // Reset subcategory selection
                $('#sub-category').val('');

                // Check if any sub-categories are available for the selected category
                if (!hasSubCategory) {
                    // Add a default option if no sub-categories are available
                    if ($('#sub-category option.default-option').length === 0) {
                        $('#sub-category').append(
                            '<option class="default-option" value="" disabled>No Sub Categories Available</option>'
                        );
                    }
                } else {
                    // Remove the default option if sub-categories are available
                    $('#sub-category option.default-option').remove();
                }
            });
        });
</script>


<script>
    document.addEventListener("trix-file-accept", function(e) {
            e.preventDefault()
        })
</script>
@endsection
