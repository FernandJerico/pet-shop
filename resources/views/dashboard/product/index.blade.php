@extends('dashboard.layouts.admin')

@section('content-section')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product /</span> List</h4>
        <div class="row">
            <div class="col-12">
                @include('dashboard.layouts.alert')
            </div>
        </div>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Product List</h5>
            <div class="demo-inline-spacing px-3">
                <a href="{{ route('products.create') }}" type="button" class="btn btn-primary text-white">
                    <span class="tf-icons bx bx-plus"></span> Create Product
                </a>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Data Created</th>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {{-- @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $user->name }}</strong>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @switch($user->role)
                                        @case('staff')
                                            <span class="badge bg-label-primary me-1">{{ $user->role }}</span>
                                        @break

                                        @case('admin')
                                            <span class="badge bg-label-info me-1">{{ $user->role }}</span>
                                        @break

                                        @case('doctor')
                                            <span class="badge bg-label-success me-1">{{ $user->role }}</span>
                                        @break

                                        @case('patient')
                                            <span class="badge bg-label-danger me-1">{{ $user->role }}</span>
                                        @break

                                        @default
                                            <span class="badge bg-label-default me-1">{{ $user->role }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('manage-users.edit', $user->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <form action="{{ route('manage-users.destroy', $user->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <button type="submit" class="dropdown-item"><i
                                                        class="bx bx-trash me-1"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
