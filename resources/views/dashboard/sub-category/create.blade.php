@extends('dashboard.layouts.admin')

@section('content-section')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sub Category/</span> Create</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Sub Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sub-categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                id="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Sub Category</label>
                            <input type="text" class="form-control @error('name')
                                is-invalid
                            @enderror" id="name" placeholder="Vitamin" name="name" />
                            @error('name')
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
                                    <input type="radio" name="status" value="active" class="selectgroup-input"
                                        checked="">
                                    <span class="selectgroup-button">Active</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="inactive" class="selectgroup-input">
                                    <span class="selectgroup-button">Not Active</span>
                                </label>
                            </div>
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
