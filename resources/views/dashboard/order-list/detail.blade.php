@extends('dashboard.layouts.admin')

@section('content-section')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Order /</span> Detail</h4>
    <div class="row">
        <div class="col-12">
            @include('dashboard.layouts.alert')
        </div>
    </div>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="table-responsive text-nowrap p-3">
            <h5>Client Name: {{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</h5>
            <h5>Delivery Address: {{ $transaction->delivery_address }}</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>QTY</th>
                        <th>Unit</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $detail->inventory->unit }}</td>
                        <td>{{ $detail->product->product_name }} ({{ $detail->inventory->size }})</td>
                        <td>{{ number_format($detail->inventory->price) }}</td>
                        <td>Rp {{ number_format($detail->total) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end"><b>Total</b></td>
                        <td><b>Rp {{ number_format($transaction->amount) }}</b></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h5>Payment Method: {{ $transaction->payment_method }}</h5>
                </div>
                <div class="col-md-6">
                    @if ($transaction->status == 'pending')
                    <h5>Order Status: <span class="badge bg-label-warning me-1">Pending</span></h5>
                    @elseif ($transaction->status == 'success')
                    <h5>Order Status: <span class="badge bg-label-primary me-1">Success</span></h5>
                    @else
                    <h5>Order Status: <span class="badge bg-label-danger me-1">Cancel</span></h5>
                    @endif
                </div>
                <div class="col-md-6">
                    @if ($transaction->payment_status == 0)
                    <h5>Payment Status: <span class="badge bg-label-dark me-1">Unpaid</span></h5>
                    @elseif ($transaction->payment_status == 1)
                    <h5>Payment Status: <span class="badge bg-label-dark me-1">Paid</span></h5>
                    @endif
                </div>
                <div class="col-md-6">
                    <form action="{{ route('admin.order-list.update', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if ($transaction->status == 'pending')
                        <button type="submit" class="btn btn-primary text-white btn-sm" name="status" value="success">
                            Success
                        </button>
                        <button type="submit" class="btn btn-danger text-white btn-sm" name="status" value="cancel">
                            Cancel
                        </button>
                        @elseif ($transaction->status == 'success')
                        <button type="submit" class="btn btn-dark text-white btn-sm" name="status" value="pending">
                            Pending
                        </button>
                        <button type="submit" class="btn btn-danger text-white btn-sm" name="status" value="cancel">
                            Cancel
                        </button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
@endsection
