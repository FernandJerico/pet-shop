@extends('dashboard.layouts.admin')

@section('content-section')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Order /</span> List</h4>
    <div class="row">
        <div class="col-12">
            @include('dashboard.layouts.alert')
        </div>
    </div>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Order List</h5>
        <div class="demo-inline-spacing px-3">
            <a href="{{ route('admin.inventories.create') }}" type="button" class="btn btn-primary text-white">
                <span class="tf-icons bx bx-plus"></span> Create Order
            </a>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table" id="datatables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date Created</th>
                        <th>Address</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Paid</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                            <strong>{{ $transaction->created_at->format('d M Y')
                                }}</strong>

                        </td>
                        <td>{{ $transaction->delivery_address }}</td>
                        <td>
                            @foreach ($transaction->transactionDetails as $detail)
                            <ul>
                                <li>{{ $detail->product->product_name }} - {{ $detail->inventory->size }} - {{
                                    $detail->quantity }} {{ $detail->inventory->unit }}</li>
                            </ul>

                            @endforeach
                        </td>
                        <td>Rp {{ number_format($transaction->amount) }}</td>
                        <td>
                            @if ($transaction->status == 'pending')
                            <span class="badge bg-label-warning me-1">pending</span>
                            @elseif ($transaction->status == 'success')
                            <span class="badge bg-label-primary me-1">success</span>
                            @else
                            <span class="badge bg-label-danger me-1">cancel</span>
                            @endif
                        </td>
                        <td>
                            @if ($transaction->paid == 0)
                            <span class="badge bg-label-dark me-1">no</span>
                            @else
                            <span class="badge bg-label-primary me-1">yes</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('admin.order-list.edit', $transaction->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <form action="{{ route('admin.order-list.update-paid', $transaction->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item">
                                            <i class="bx bx-wallet me-1"></i>
                                            Mark as Paid
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.order-list.destroy', $transaction->id) }}"
                                        method="POST">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>
                                            Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
@endsection
