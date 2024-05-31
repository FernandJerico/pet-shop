@extends('dashboard.layouts.admin')

@section('content-section')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Edit</h4>
        <div class="row">
            <div class="col-12">
                @include('dashboard.layouts.alert')
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">System Info</h5>
            <form class="px-4" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ $meta['name'] ?? '' }}" />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="short_name">Short Name</label>
                    <input type="text" class="form-control @error('short_name') is-invalid @enderror" id="short_name"
                        name="short_name" value="{{ $meta['short_name'] ?? '' }}" />
                    @error('short_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    @if (isset($meta['logo']))
                        <p>Current Logo: {{ $meta['logo'] }}</p>
                        <img src="{{ Storage::url($meta['logo']) }}" alt="logo" width="100px">
                    @endif
                    <input class="form-control mt-1 @error('logo') is-invalid @enderror" type="file" id="logo"
                        name="logo">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cover" class="form-label">Cover</label>
                    @if (isset($meta['cover']))
                        <p>Current Cover: {{ $meta['cover'] }}</p>
                        <img src="{{ Storage::url($meta['cover']) }}" alt="cover" width="100px">
                    @endif
                    <input class="form-control mt-1 @error('cover') is-invalid @enderror" type="file" id="cover"
                        name="cover">
                    @error('cover')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mb-5">Update</button>
            </form>
        </div>
    </div>
    </div>
@endsection
