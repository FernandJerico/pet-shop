@extends('layouts.main')

@section('main-content')
<div class="py-5">
    <div class="container">
        <div class="card rounded-0">
            <div class="card-body">
                <h3 class="text-center"><b>Checkout</b></h3>
                <hr class="border-dark">
                <form action="{{ route('checkout') }}" id="place_order" method="POST">
                    @csrf
                    <div class="row row-col-1 justify-content-center">
                        <div class="col-6">
                            <div class="form-group col">
                                <label for="delivery_address" class="control-label">Delivery Address</label>
                                <textarea id="delivery_address" cols="30" rows="3" name="delivery_address"
                                    class="form-control" style="resize:none">{{ auth()->user()->address }}</textarea>
                            </div>
                            <div class="col">
                                <span>
                                    <h4><b>Total:</b> Rp {{ number_format($grand_total) }}</h4>
                                </span>
                            </div>
                            <hr>
                            <div class="col my-3">
                                <h4 class="text-muted">Payment Method</h4>
                                <div class="d-flex w-100 justify-content-between">
                                    <button type="submit" class="btn btn-flat btn-dark" name="cod"
                                        value="Cash on Delivery">Cash on Delivery</button>
                                    <button class="btn btn-flat btn-success" type="submit" name="wa"
                                        value="Whatsapp">Whatsapp</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
