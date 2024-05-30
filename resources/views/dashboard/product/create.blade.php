@extends('dashboard.layouts.admin')

@section('content-section')
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
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Product Name</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    id="name" placeholder="Royal Canin" name="name" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category">Category Product</label>
                                <select class="form-select @error('category') is-invalid @enderror" name="category"
                                    id="category">
                                    <option value="">Select Category</option>
                                    {{-- @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach --}}
                                    <option value="Food">Food</option>
                                    <option value="Accessories">Accessories</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sub-category">Sub Category Product</label>
                                <select class="form-select @error('sub-categiry') is-invalid @enderror" name="sub-category"
                                    id="category">
                                    <option value="">Select Category First</option>
                                    {{-- @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach --}}
                                    <option value="Cat">Cat</option>
                                    <option value="Dog">Dog</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                                <trix-editor input="description"></trix-editor>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="Active" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="Not Active" class="selectgroup-input">
                                        <span class="selectgroup-button">Not Active</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="images" class="form-label">Images</label>
                                <input
                                    class="form-control @error('images')
                                is-invalid
                            @enderror"
                                    type="file" id="images" name="images">
                                @error('images')
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

    <script>
        document.addEventListener("trix-file-accept", function(e) {
            e.preventDefault()
        })
    </script>
@endsection
