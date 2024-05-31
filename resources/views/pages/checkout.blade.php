@extends('layouts.main')

@section('main-content')
    <div class="py-5">
        <div class="container">
            <div class="card rounded-0">
                <div class="card-body">
                    <h3 class="text-center"><b>Checkout</b></h3>
                    <hr class="border-dark">
                    <form action="#" id="place_order" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="">
                        <input type="hidden" name="payment_method" value="cod">
                        <input type="hidden" name="paid" value="0">
                        <div class="row row-col-1 justify-content-center">
                            <div class="col-6">
                                <div class="form-group col">
                                    <label for="delivery_address" class="control-label">Delivery Address</label>
                                    <textarea id="delivery_address" cols="30" rows="3" name="delivery_address" class="form-control"
                                        style="resize:none">Address Line</textarea>
                                </div>
                                <div class="col">
                                    <span>
                                        <h4><b>Total:</b> Rp 1.000.000</h4>
                                    </span>
                                </div>
                                <hr>
                                <div class="col my-3">
                                    <h4 class="text-muted">Payment Method</h4>
                                    <div class="d-flex w-100 justify-content-between">
                                        <button class="btn btn-flat btn-dark" type="submit">Cash on Delivery</button>
                                        <button class="btn btn-flat btn-success">Whatsapp</button>
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
